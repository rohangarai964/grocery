<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load DB Utility
        $this->load->dbutil();
    }

    public function export_database()
    {
        // Backup your entire database and assign it to a variable
        $prefs = array(
            'format'      => 'txt',             // gzip, zip, txt
            'filename'    => 'my_backup.sql'     // file name (for zip format)
        );

        $backup =& $this->dbutil->backup($prefs);

        // Load file helper
        $this->load->helper('file');

        // Save backup file to server (optional)
        write_file('backup/my_backup_' . date('Y-m-d_H-i-s') . '.sql', $backup);

        // Download directly
        $this->load->helper('download');
        force_download('my_backup_' . date('Y-m-d_H-i-s') . '.sql', $backup);
    }
}
