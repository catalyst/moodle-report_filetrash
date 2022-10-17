<?php
// This file is part of the File Trash report by Barry Oosthuizen - http://elearningstudio.co.uk
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
define('CLI_SCRIPT', true);

require(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/report/filetrash/form.php');
raise_memory_limit(MEMORY_HUGE);
core_php_time_limit::raise();

$report = new report_filetrash_compare();
$count = 0;
foreach ($report->orphanedfiles as $file) {
    // Sanity check - is this file really not in the files table - not really needed as above function does this work but just in case.
    $existing = $DB->get_record('files', ['contenthash' => $file['filename']]);
    if (empty($existing)) {
        unlink($file['filepath'].'/'.$file['filename'], $newpath.'/'.$file['filename']);
        $count++;
    }

}
mtrace("Deleted $count files");