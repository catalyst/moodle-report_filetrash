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
$size = 0;
foreach ($report->orphanedfiles as $file) {
    mtrace($file['filepath'].'/'.$file['filename']. "(".$file['filesize'].")" ." ".$file['createtime']);
    $size = $size + $file['filesize'];

}
mtrace("total size of orphaned files:". display_size($size));
//print_object($report->orphanedfiles);