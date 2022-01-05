<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class ReportsStatistics extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('User_model', 'user');
        $this->load->model('Transaction_model', 'transaction');
        if ($this->user->is_role() != 1 && $this->user->is_role() != 4) {
            redirect('auth/blocked');
        }
    }
    public function index()
    {
        $title  = 'Sales Report';
        $user   = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data = array(
            'title'     => $title,
            'user'      => $user,
        );

        $this->template->load('templates/admin/templates', 'reports-statistics/sales-reports', $data);
    }

    public function dailyreports()
    {
        $title      = 'Sales Report';
        $subtitle   = 'Daily Reports';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $date   = $this->input->post('date');
        $month  = $this->input->post('month');
        $year   = $this->input->post('year');

        $dailyreports = $this->transaction->dailyReports($date, $month, $year);

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'date'      => $date,
            'month'     => $month,
            'year'      => $year,
            'dailyreports' => $dailyreports,
        );

        $this->template->load('templates/admin/templates', 'reports-statistics/daily-reports', $data);
    }

    public function monthreports()
    {
        $title      = 'Sales Report';
        $subtitle   = 'Month Reports';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $month  = $this->input->post('month');
        $year   = $this->input->post('year');

        $monthreports = $this->transaction->monthReports($month, $year);

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'month'     => $month,
            'year'      => $year,
            'monthreports' => $monthreports,
        );

        $this->template->load('templates/admin/templates', 'reports-statistics/month-reports', $data);
    }

    public function yearreports()
    {
        $title      = 'Sales Report';
        $subtitle   = 'Year Reports';
        $user       = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $year   = $this->input->post('year');

        $yearreports = $this->transaction->yearReports($year);

        $data = array(
            'title'     => $title,
            'subtitle'  => $subtitle,
            'user'      => $user,
            'year'      => $year,
            'yearreports' => $yearreports,
        );

        $this->template->load('templates/admin/templates', 'reports-statistics/year-reports', $data);
    }
}
