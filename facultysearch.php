<?php
include_once('db_conn.php');
// session_start();

/*
 * ============================================================
 *  CONFIG — one entry per "type" in the dropdown.
 *  This is the ONLY place you edit if a table/column changes,
 *  or if you want to add a 20th category later.
 *
 *  key      -> value shown in <select>, also used to build the
 *              div id ($key . "Div") and table id ($key . "Table")
 *  label    -> heading shown to the user
 *  table    -> real MySQL table name
 *  columns  -> [ db_column => "Header shown in table" ]
 *              (id and faculty_id are deliberately left out —
 *               they're internal, not useful to display)
 *  search   -> which db_column the search box filters on
 *  link     -> OPTIONAL. db_column that holds a URL
 *              (certificate_link / proof_link / achievement_link / url ...)
 *              If set, that column is rendered as a "View" button
 *              instead of a plain text cell.
 * ============================================================
 */
$config = [
  'fdp' => [
    'label'   => 'FDP Attended',
    'table'   => 'fdp',
    'columns' => [
      'name'       => 'Name',
      'department' => 'Department',
      'fdpname'    => 'FDP Name',
      'org'        => 'Organisation',
      'mode'       => 'Mode',
      'duration'   => 'Duration',
      'startdate'  => 'Start Date',
      'enddate'    => 'End Date',
    ],
    'search' => 'fdpname',
    'link'   => 'certificate_link',
  ],
  'fdporg' => [
    'label'   => 'FDP Organized',
    'table'   => 'fdporg',
    'columns' => [
      'academic_year' => 'Academic Year',
      'faculty_name'  => 'Name',
      'fdp_name'      => 'FDP Name',
      'association'   => 'Association',
      'mode'          => 'Mode',
      'start_date'    => 'Start Date',
      'end_date'      => 'End Date',
      'duration'      => 'Duration',
    ],
    'search' => 'fdp_name',
    'link'   => 'certificate_link',
  ],
  'ffworkshop' => [
    'label'   => 'Workshop / Seminar Attended',
    'table'   => 'ffworkshop',
    'columns' => [
      'academic_year' => 'Academic Year',
      'name'          => 'Name',
      'workshop'      => 'Workshop Name',
      'org'           => 'Organisation',
      'start_date'    => 'Start Date',
      'end_date'      => 'End Date',
      'duration'      => 'Duration',
      'mode'          => 'Mode',
    ],
    'search' => 'workshop',
    'link'   => 'certificate_link',
  ],
  'paperpublications' => [
    'label'   => 'Paper Publication (Journal)',
    'table'   => 'paperpublications',
    'columns' => [
      'faculty_name'  => 'Name',
      'title'         => 'Title',
      'journal'       => 'Journal',
      'indexing_type' => 'Indexing',
      'volume'        => 'Volume',
      'number'        => 'Issue No.',
      'academic_year' => 'Academic Year',
      'month'         => 'Month',
    ],
    'search' => 'title',
    'link'   => 'proof_link',
  ],
  'conferences' => [
    'label'   => 'Conference Paper Publication',
    'table'   => 'conferences',
    'columns' => [
      'academic_year'          => 'Academic Year',
      'faculty_name'           => 'Name',
      'author_type'            => 'Author Type',
      'paper_title'            => 'Paper Title',
      'conference_proceedings' => 'Conference / Proceedings',
      'ugc_scopus'             => 'UGC / Scopus',
    ],
    'search' => 'paper_title',
    'link'   => 'proof_link',
  ],
  'certificates' => [
    'label'   => 'Certificates',
    'table'   => 'certificates',
    'columns' => [
      'academic_year' => 'Academic Year',
      'name'          => 'Name',
      'certificate'   => 'Certificate',
      'org'           => 'Organisation',
      'start_date'    => 'Start Date',
      'end_date'      => 'End Date',
      'duration'      => 'Duration',
      'mode'          => 'Mode',
    ],
    'search' => 'certificate',
    'link'   => 'certificate_link',
  ],
  'bookpublish' => [
    'label'   => 'Book Published',
    'table'   => 'bookpublish',
    'columns' => [
      'academic_year'   => 'Academic Year',
      'faculty_name'    => 'Name',
      'author_position' => 'Author Position',
      'title'           => 'Title',
      'publisher'       => 'Publisher',
      'scopus_sci'      => 'Scopus / SCI',
      'isbn'            => 'ISBN',
    ],
    'search' => 'title',
    'link'   => 'proof_link',
  ],
  'bookedited' => [
    'label'   => 'Book Edited',
    'table'   => 'bookedited',
    'columns' => [
      'faculty_name'   => 'Name',
      'no_of_authors'  => 'No. of Authors',
      'book_name'      => 'Book Name',
      'publisher_name' => 'Publisher',
      'isbn_number'    => 'ISBN',
      'academic_year'  => 'Academic Year',
      'month'          => 'Month',
    ],
    'search' => 'book_name',
    'link'   => 'proof_link',
  ],
  'textbook' => [
    'label'   => 'Textbook Published',
    'table'   => 'textbook',
    'columns' => [
      'academic_year'   => 'Academic Year',
      'faculty_name'    => 'Name',
      'main_editor'     => 'Main Editor',
      'textbook_name'   => 'Textbook Name',
      'publisher_name'  => 'Publisher',
      'month'           => 'Month',
    ],
    'search' => 'textbook_name',
    'link'   => 'url',
  ],
  'patents' => [
    'label'   => 'Patents',
    'table'   => 'patents',
    'columns' => [
      'academic_year'      => 'Academic Year',
      'faculty_name'       => 'Name',
      'patent_details'     => 'Patent Details',
      'area_of_patent'     => 'Area',
      'application_number' => 'Application No.',
      'status'             => 'Status',
      'patent_type'        => 'Type',
      'filing_agency'      => 'Filing Agency',
    ],
    'search' => 'patent_details',
    'link'   => 'proof_link',
  ],
  'nptel' => [
    'label'   => 'NPTEL Courses',
    'table'   => 'nptel',
    'columns' => [
      'academic_year' => 'Academic Year',
      'faculty_name'  => 'Name',
      'course_name'   => 'Course Name',
      'duration'      => 'Duration',
      'start_date'    => 'Start Date',
      'end_date'      => 'End Date',
      'percentage'    => 'Percentage',
      'top_percentage' => 'Top %',
      'remarks'       => 'Remarks',
    ],
    'search' => 'course_name',
    'link'   => 'certificate_link',
  ],
  'achievements' => [
    'label'   => 'Achievements',
    'table'   => 'achievements',
    'columns' => [
      'academic_year'    => 'Academic Year',
      'faculty_name'     => 'Name',
      'award_name'       => 'Award Name',
      'description'      => 'Description',
      'achievement_date' => 'Date',
      'organization'     => 'Organisation',
    ],
    'search' => 'award_name',
    'link'   => 'achievement_link',
  ],
  'outside_participations' => [
    'label'   => 'Outside Participation',
    'table'   => 'outside_participations',
    'columns' => [
      'academic_year'            => 'Academic Year',
      'faculty_name'             => 'Name',
      'date_attended'            => 'Date Attended',
      'organization'             => 'Organisation',
      'conference_journal_name'  => 'Conference / Journal',
      'type'                     => 'Type',
    ],
    'search' => 'conference_journal_name',
    'link'   => 'proof_link',
  ],
  'reviewer_activities' => [
    'label'   => 'Reviewer Activities',
    'table'   => 'reviewer_activities',
    'columns' => [
      'academic_year'            => 'Academic Year',
      'faculty_name'             => 'Name',
      'date_attended'            => 'Date',
      'organization'             => 'Organisation',
      'conference_journal_name'  => 'Conference / Journal',
      'type'                     => 'Type',
    ],
    'search' => 'conference_journal_name',
    'link'   => 'proof_link',
  ],
  'professional_membership' => [
    'label'   => 'Professional Membership',
    'table'   => 'professional_membership',
    'columns' => [
      'faculty_name'     => 'Name',
      'membership_name'  => 'Membership',
      'membership_id'    => 'Membership ID',
      'membership_type'  => 'Type',
      'start_date'       => 'Start Date',
      'end_date'         => 'End Date',
    ],
    'search' => 'membership_name',
    'link'   => 'proof_link',
  ],
  'phd_details' => [
    'label'   => 'PhD Details',
    'table'   => 'phd_details',
    'columns' => [
      'faculty_name'        => 'Name',
      'university_name'     => 'University',
      'status'              => 'Status',
      'domain_name'         => 'Domain',
      'date_of_completion'  => 'Completion Date',
      'pursuing_year'       => 'Pursuing Year',
    ],
    'search' => 'university_name',
    'link'   => 'proof_link',
  ],
  'consultancy_work' => [
    'label'   => 'Consultancy Work',
    'table'   => 'consultancy_work',
    'columns' => [
      'academic_year'     => 'Academic Year',
      'faculty_name'      => 'Name',
      'description'       => 'Description',
      'organization'      => 'Organisation',
      'amount'            => 'Amount',
      'start_date'        => 'Start Date',
      'end_date'          => 'End Date',
      'duration'          => 'Duration',
      'students_involved' => 'Students Involved',
    ],
    'search' => 'organization',
    'link'   => 'proof_link',
  ],
  'working_models' => [
    'label'   => 'Working Models / Projects',
    'table'   => 'working_models',
    'columns' => [
      'academic_year'  => 'Academic Year',
      'model_name'     => 'Model Name',
      'duration'       => 'Duration',
      'students_count' => 'Students Count',
      'domain_name'    => 'Domain',
    ],
    'search' => 'model_name',
    'link'   => 'proof_link',
  ],
  'funding_projects' => [
    'label'   => 'Funding Projects',
    'table'   => 'funding_projects',
    'columns' => [
      'academic_year' => 'Academic Year',
      'faculty_name'  => 'Name',
      'title'         => 'Title',
      'agency_name'   => 'Agency',
      'amount'        => 'Amount',
      'start_date'    => 'Start Date',
      'end_date'      => 'End Date',
      'duration'      => 'Duration',
      'funding_type'  => 'Funding Type',
    ],
    'search' => 'title',
    'link'   => 'proof_link',
  ],
];

// Whitelist of real table names, built straight from $config, so no
// user-controlled value is ever concatenated into SQL as a table name.
$allowedTables = array_column($config, 'table');
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="icon" type="image/x-icon" href="icon2.png">
  <title>CERTIFICATE MAINTANCE SYSTEM</title>
  <link rel="stylesheet" href="lightbox.min.css">
  <script src="lightbox-plus-jquery.min.js"></script>
  <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700&display=swap');

    :root {
      --bg-cream: #f4efe4;
      --bg-dark: #17120e;
      --bg-dark2: #211a14;
      --gold: #caa24c;
      --gold-light: #e6c877;
      --white: #ffffff;
      --ink: #2a231c;
      --muted: #7a7166;
      --border: #e6ddc8;
      --shadow: 0 10px 30px rgba(23, 18, 14, 0.10);
    }

    * {
      box-sizing: border-box;
    }

    body {
      background: var(--bg-cream);
      font-family: 'Poppins', sans-serif;
      color: var(--ink);
      margin: 0;
      padding-bottom: 60px;
    }

    h1 {
      font-family: 'Playfair Display', serif;
      color: var(--ink);
      font-size: 28px;
      margin: 26px 0 16px 0;
    }

    h1::after {
      content: "";
      display: block;
      width: 64px;
      height: 3px;
      background: var(--gold);
      margin-top: 10px;
      border-radius: 2px;
    }

    .topbar {
      background: linear-gradient(135deg, var(--bg-dark) 0%, var(--bg-dark2) 100%);
      padding: 18px 28px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      box-shadow: var(--shadow);
    }

    .topbar .n {
      text-decoration: none;
    }

    .btn,
    button {
      background: var(--bg-dark);
      color: var(--gold-light);
      border: 1px solid var(--gold);
      border-radius: 999px;
      padding: 10px 22px;
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
      font-size: 14px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn:hover,
    button:hover {
      background: var(--gold);
      color: var(--bg-dark);
    }

    .panel {
      background: var(--white);
      margin: 24px 32px;
      padding: 24px 28px;
      border-radius: 14px;
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    select#mySelect {
      background-color: var(--white) !important;
      color: var(--ink) !important;
      border: 1px solid var(--gold) !important;
      border-radius: 8px;
      padding: 11px 16px;
      font-size: 15px;
      font-family: 'Poppins', sans-serif;
      cursor: pointer;
      width: 100% !important;
      max-width: 420px;
      margin-bottom: 20px;
    }

    .searchbox {
      background-color: var(--white);
      background-image: url('/css/searchicon.png');
      background-position: 12px 12px;
      background-repeat: no-repeat;
      width: 100% !important;
      max-width: 480px;
      font-size: 15px;
      padding: 11px 16px 11px 40px;
      border: 1px solid var(--border);
      border-radius: 8px;
      margin: 0 0 16px 0 !important;
    }

    table.data-table {
      border-collapse: collapse;
      width: 100%;
      background: var(--white);
      font-size: 14.5px;
      border-radius: 10px;
      overflow: hidden;
      margin: 0 !important;
    }

    table.data-table th,
    table.data-table td {
      text-align: left;
      padding: 12px 14px;
      border-bottom: 1px solid var(--border);
    }

    table.data-table tr.header {
      background: var(--bg-dark);
      color: var(--gold-light);
      font-weight: 600;
    }

    table.data-table tbody tr:hover {
      background-color: #faf6ea;
    }

    .n {
      text-decoration: none;
    }

    .scroll {
      height: auto;
      width: 100%;
      overflow-x: auto;
    }

    .optionDiv {
      display: none;
    }

    .empty-row td {
      color: var(--muted);
      font-style: italic;
    }

    @media only screen and (max-width: 900px) {
      .panel {
        margin: 16px;
        padding: 18px;
      }
    }
  </style>
</head>

<body>
  <div class="topbar">
    <a href="admin.php" class="n"><button type="button" class="btn">Back</button></a>
    <a href="logout.php" class="n"><button type="button" class="btn">Logout</button></a>
  </div>

  <div class="panel">
    <select class='btn' id="mySelect" onchange="myFun()" name='opt' required>
      <option value=''>Select the Option</option>
      <?php foreach ($config as $key => $cfg): ?>
        <option value='<?php echo htmlspecialchars($key); ?>'><?php echo htmlspecialchars($cfg['label']); ?></option>
      <?php endforeach; ?>
    </select>

    <div id="demo">
      <?php foreach ($config as $key => $cfg):
        $table   = $cfg['table'];
        $columns = $cfg['columns'];
        $linkCol = $cfg['link'] ?? null;

        if (!in_array($table, $allowedTables, true)) {
          continue;
        }

        $query  = "SELECT * FROM `$table`";
        $result = mysqli_query($conn, $query);
      ?>
        <div id="<?php echo $key; ?>Div" class="optionDiv">
          <h1><?php echo htmlspecialchars($cfg['label']); ?></h1>
          <input type="text" class="searchbox" id="search_<?php echo $key; ?>"
            onkeyup="filterTable('<?php echo $key; ?>')"
            placeholder="Search <?php echo htmlspecialchars($cfg['label']); ?>...">
          <div class="scroll">
            <table class="data-table" id="table_<?php echo $key; ?>"
              data-searchcol="<?php echo array_search($cfg['search'], array_keys($columns)); ?>">
              <thead>
                <tr class="header">
                  <?php foreach ($columns as $header): ?>
                    <th><?php echo htmlspecialchars($header); ?></th>
                  <?php endforeach; ?>
                  <?php if ($linkCol): ?>
                    <th>Proof</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                  <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <?php foreach (array_keys($columns) as $col): ?>
                        <td><?php echo htmlspecialchars($row[$col] ?? ''); ?></td>
                      <?php endforeach; ?>
                      <?php if ($linkCol): ?>
                        <td>
                          <?php if (!empty($row[$linkCol])): ?>
                            <a href="<?php echo htmlspecialchars($row[$linkCol]); ?>" target="_blank" rel="noopener">
                              <button type="button" class="btn">View</button>
                            </a>
                          <?php else: ?>
                            &mdash;
                          <?php endif; ?>
                        </td>
                      <?php endif; ?>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr class="empty-row">
                    <td colspan="<?php echo count($columns) + ($linkCol ? 1 : 0); ?>">No records found.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <br>

  <script>
    // Show only the section matching the dropdown's value (e.g. "fdp" -> "fdpDiv")
    function myFun() {
      var sections = document.getElementsByClassName('optionDiv');
      for (var i = 0; i < sections.length; i++) {
        sections[i].style.display = 'none';
      }
      var val = document.getElementById("mySelect").value;
      if (val) {
        var target = document.getElementById(val + "Div");
        if (target) target.style.display = 'block';
      }
    }

    // One generic filter for every table, driven by the table's
    // data-searchcol attribute (set server-side from $cfg['search']).
    function filterTable(key) {
      var input = document.getElementById("search_" + key);
      var filter = input.value.toUpperCase();
      var table = document.getElementById("table_" + key);
      var col = parseInt(table.getAttribute("data-searchcol"), 10);
      var rows = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");

      for (var i = 0; i < rows.length; i++) {
        var td = rows[i].getElementsByTagName("td")[col];
        if (td) {
          var txt = td.textContent || td.innerText;
          rows[i].style.display = (txt.toUpperCase().indexOf(filter) > -1) ? "" : "none";
        }
      }
    }
  </script>
</body>

</html>