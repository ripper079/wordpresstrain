<!-- https://www.youtube.com/watch?v=rrpyotWlR2g&list=PLD8nQCAhR3tT3ehpyOpoYeUj3KHDEVK9h&index=21 -->
<!-- 2.30 min -->
<?php

//Useful of printing/debugging apps
// echo '<pre>';
// print_r(get_template_directory_uri());
// print_r(get_stylesheet_uri());
// wp_die();

function Danielthemeadapt_enqueue_scripts()
{
    //The benfits with registering and enqueueing in this style is that we can implement som logic when implementing script e.i conditionally or multiply times

    //Register Styles
    //Custom our
    wp_register_style('style-css', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');
    //Bootstrap
    wp_register_style('bootstrap-css', get_template_directory_uri() . '/assets/src/library/css/bootstrap.min.css', [], false, 'all');

    //Register scripts
    //Custom our
    wp_register_script('main-js', get_template_directory_uri() . '/assets/main.js', [], filemtime(get_template_directory() . '/assets/main.js'), true);
    //Bootstrap
    wp_register_script('bootstrap-js', get_template_directory_uri() . '/assets/src/library/js/bootstrap.min.js', ['jquery'], false, true);

    //Enqueue Styles
    //Custom our
    wp_enqueue_style('style-css');
    //Bootstrap
    wp_enqueue_style('bootstrap-css');

    //Enqueue Scripts
    //Custom our
    wp_enqueue_script('main-js');
    //Bootstrap
    wp_enqueue_script('bootstrap-js');

}

add_action('wp_enqueue_scripts', 'Danielthemeadapt_enqueue_scripts');




function theme_setup()
{
    //Lets wordpress manage the title tag (Settings->General -> SiteTitle+Tagline)
    add_theme_support('title-tag');
    //Enable support for a custom theme logo (Appearance->Customize->Sity Identity->Logo )
    add_theme_support('custom-logo', array(
        'height'      => 160,
        'width'       => 160,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ));
    //Enable support for a custom background (Appearance->Customize-> Colors&BackgroundImage)
    add_theme_support('custom-background', array(
        'default-color'          => '#fff',
        'default-image'          => '',
        'default-repeat'        => 'no-repeat'
    ));
    //Enable support for thumbnail when creating new posts newpost->featuredimage
    add_theme_support('post-thumbnails');
    //Enable
    add_theme_support('customize-selective-refresh-widgets');
    //Automatic generation of rss feeds
    add_theme_support('automatic-feed-links');
    //Special support for HTML5 features
    add_theme_support('html5', array(
        'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script'
    ));
    //. It allows you to customize the visual appearance of the editor to match the front-end styling of your theme.
    add_editor_style();
    //Enable support for the block styles feature introduced in the WordPress Gutenberg editor.
    add_theme_support('wp-block-styles');
    //Enabale support for the wide alignment option in the Gutenberg editor.
    add_theme_support('align-wide');
    //Max content width supported
    global $content_width;
    if (! isset($content_width)) {
        $content_width = 1240;
    }
}
add_action('after_setup_theme', 'theme_setup');


function return_my_name()
{
    return "Daniel";
}

function scrapePage()
{

    $html = file_get_contents("https://stats.swehockey.se/ScheduleAndResults/Overview/14834");

    $doc = new DOMDocument();
    libxml_use_internal_errors(true); // Disable error reporting for loadHTML()
    $doc->loadHTML($html);

    $titleTags = $doc->getElementsByTagName('title');
    if ($titleTags->length > 0) {
        $title = $titleTags->item(0)->textContent;
        echo "<h2>Title: " . $title . "</h2>";
    } else {
        echo "No title found in the HTML.";
    }

    $count_teams = 10;
    $count_columns = 12;

    $doc = new DOMDocument();
    libxml_use_internal_errors(true); // Disable error reporting for loadHTML()
    $doc->loadHTML($html);

    $xpath = new DOMXPath($doc);
    $classname = "tdNormal";
    $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ') and not(@colspan)]");

    $filenameRawcontent = "raw_teamshockey.csv";

    //Creates a file where each line is a cell value
    if ($elements->length > 0) {
        $count_lines = 0;
        $file = fopen($filenameRawcontent, "w");
        for ($i = 1; $i <= $elements->length; $i++) {
            $element = $elements->item(($i) - 1);

            if (($i % ($count_columns + 1)) === 0) {
                fwrite($file, $element->textContent . PHP_EOL);
                //echo "<br>";
                $count_lines++;
            } else {
                //echo " " . $element->textContent . ",";
                fwrite($file, $element->textContent . PHP_EOL);
            }
            if ($count_lines === $count_teams) {
                break;
            }
        }
        fclose($file);
    } else {
        echo "No elements found with the specified class name.";
    }


    //Removes all blank rows
    // Specify the input and output file paths
    $inputFile = $filenameRawcontent;
    $outputFile = 'removedblanklines_teamshockey.csv';

    // Open the input and output files
    $inputHandle = fopen($inputFile, 'r');
    $outputHandle = fopen($outputFile, 'w');

    if ($inputHandle && $outputHandle) {
        // Read the input file line by line
        while (($line = fgets($inputHandle)) !== false) {
            // Check if the line is not empty or only contains whitespace
            if (trim($line) !== '') {
                // Write the non-empty line to the output file
                fwrite($outputHandle, $line);
            }
        }

        // Close the file handles
        fclose($inputHandle);
        fclose($outputHandle);

        //echo "Empty lines removed successfully.";
    } else {
        echo "Error opening the input or output file.";
    }


    $inputFile2 = $outputFile;       // Path to the input file
    $outputFile2 = 'formatfile.csv';    // Path to the output file

    $inputLines = file($inputFile2, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);  // Read the input file into an array

    $outputLines2 = array_chunk($inputLines, 13);  // Split the input lines into chunks of 13 lines each

    $output2 = '';

    foreach ($outputLines2 as $line) {
        $formattedLine = implode(',', $line);
        $output2 .= $formattedLine . ",\n";  // Append a comma and newline to each line
    }

    file_put_contents($outputFile2, $output2);  // Write the formatted content to the output file

    //echo "File converted successfully.";


    $filename = $outputFile2;  // Replace with the path to your file

    $file = fopen($filename, 'r');  // Open the file in read mode

    $myArrayOfStatsRow = [];
    if ($file) {
        while (($line = fgets($file)) !== false) {
            // Process the current line
            $columns = explode(',', $line);

            $myStatsRow = new StatsRow();
            $myStatsRow->Rank = $columns[0];
            $myStatsRow->Team = $columns[1];
            $myStatsRow->GamesPlayed = $columns[2];
            $myStatsRow->Won = $columns[3];
            $myStatsRow->Tied = $columns[4];
            $myStatsRow->Lost = $columns[5];


            // Extract numbers using regular expressions
            preg_match_all('/\d+/', $columns[6], $matches);

            $result = array_map('intval', $matches[0]); // Convert the matched numbers to integers

            $myStatsRow->GoalFor = $result[0];
            $myStatsRow->GoalAgainst = $result[1];
            $myStatsRow->GoalDifference = $result[2];

            $myStatsRow->TotalPoints = $columns[7];
            $myStatsRow->OverTimeWon = $columns[8];
            $myStatsRow->OverTimeLost = $columns[9];
            $myStatsRow->GameWinningShotsWon = $columns[10];
            $myStatsRow->GameWinningShotsLost = $columns[11];

            $myArrayOfStatsRow[] = $myStatsRow;

        }

        fclose($file);  // Close the file
    } else {
        echo "Failed to open the file.";
    }

    //Remove all created files
    unlink($filenameRawcontent);
    unlink($outputFile);
    unlink($outputFile2);

    ?>
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Rank</th>
      <th scope="col">Lag</th>
      <th scope="col">Spelade Matcher</th>
      <th scope="col">Vinster</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($myArrayOfStatsRow as $aRowStat) { ?>
    <tr>
        
      <th scope="row"><?php echo $aRowStat->Rank ?></th>
      <td><?php echo $aRowStat->Team ?></td>
      <td><?php echo $aRowStat->GamesPlayed ?></td>
      <td><?php echo $aRowStat->Won ?></td>      
    </tr>
    <?php } ?>
  </tbody>
</table>
    <?php

}

class StatsRow
{
    public $Rank;
    public $Team;
    public $GamesPlayed;
    public $Won;
    public $Tied;
    public $Lost;
    public $GoalFor;
    public $GoalAgainst;
    public $GoalDifference;
    public $TotalPoints;
    public $OverTimeWon;
    public $OverTimeLost;
    public $GameWinningShotsWon;
    public $GameWinningShotsLost;

    // public function __construct(
    //     $Rank,
    //     $Team,
    //     $GamesPlayed,
    //     $Won,
    //     $Tied,
    //     $Lost,
    //     $GoalFor,
    //     $GoalAgainst,
    //     $GoalDifference,
    //     $TotalPoints,
    //     $OverTimeWon,
    //     $OverTimeLost,
    //     $GameWinningShotsWon,
    //     $GameWinningShotsLost
    // ) {
    //     $this->Rank = $Rank;
    //     $this->Team = $Team;
    //     $this->GamesPlayed = $GamesPlayed;
    //     $this->Won = $Won;
    //     $this->Tied = $Tied;
    //     $this->Lost = $Lost;
    //     $this->GoalFor = $GoalFor;
    //     $this->GoalAgainst = $GoalAgainst;
    //     $this->GoalDifference = $GoalDifference;
    //     $this->TotalPoints = $TotalPoints;
    //     $this->OverTimeWon = $OverTimeWon;
    //     $this->OverTimeLost = $OverTimeLost;
    //     $this->GameWinningShotsWon = $GameWinningShotsWon;
    //     $this->GameWinningShotsLost = $GameWinningShotsLost;
    // }
}
