<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{
	public function ledger()
	{
		ini_set("max_execution_time", 600);
		if (count($_POST) == 0) {
			$data['form']["type"] = isset($_GET['type']) ? $_GET['type'] : "";
			$data['form']["currency"] = isset($_GET['currency']) ? $_GET['currency'] : "";
			$data['form']["selyrfrom"] = isset($_GET['selyrfrom']) ? $_GET['selyrfrom'] : "";
			$data['form']["selmonfrom"] = isset($_GET['selmonfrom']) ? $_GET['selmonfrom'] : "";
			$data['form']["selyrto"] = isset($_GET['selyrto']) ? $_GET['selyrto'] : "";
			$data['form']["selmonto"] = isset($_GET['selmonto']) ? $_GET['selmonto'] : "";
			$data['form']["member_id"] = isset($_GET['member_id']) ? $_GET['member_id'] : "";
			$data['report'] = "ledger";
			return $this->load->view("loader", $data);
			exit;
		}
		echo $this->ledgersheet($_POST);
	}

	public function order()
	{
		ini_set("max_execution_time", 600);
		if (count($_POST) == 0) {
			$data['form']["userid"] = isset($_GET['userid']) ? $_GET['userid'] : "";
			$data['report'] = "order";
			return $this->load->view("loader", $data);
			exit;
		}
		echo $this->ordersheet($_POST);
	}

	public function summary()
	{
		ini_set("max_execution_time", 600);
		if (count($_POST) == 0) {
			$data['form']["period"] = isset($_GET['period']) ? $_GET['period'] : "";
			$data['report'] = "summary";
			return $this->load->view("loader", $data);
		}
		echo $this->summarysheet($_POST);
	}

	public function member()
	{
		ini_set("max_execution_time", 600);
		if (count($_POST) == 0) {
			$data['form']["userid"] = isset($_GET['userid']) ? $_GET['userid'] : "";
			$data['report'] = "member";
			return $this->load->view("loader", $data);
			exit;
		}
		echo $this->membersheet($_POST);
	}

	public function star()
	{
		ini_set("max_execution_time", 0);
		if (count($_POST) == 0) {
			$data['form']["userid"] = isset($_GET['userid']) ? $_GET['userid'] : "";
			$data['form']['fl_rank'] = isset($_GET['fl_rank']) ? $_GET['fl_rank'] : 'any';
			$data['form']['period'] = isset($_GET['period']) ? $_GET['period'] : date("Y-m");
			$data['report'] = "star";
			return $this->load->view("loader", $data);
		}
		echo $this->starsheet($_POST);
	}


	public function starsheet($post)
	{
		$lang_model = $this->LanguageModel;
		$report = $this->StarModel->exportStarReport($post);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// set columns merge
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:H1');

		// set border
		$sheet->getStyle("A1:H1")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('0000ff'));

		// title font changes
		$sheet->getStyle(1)->getFont()->setBold(true);
		$sheet->getStyle(1)->getFont()->setSize(24);
		$sheet->getStyle(1)->getFont()->getColor()->setARGB("0000ff");
		$sheet->getStyle(1)->getAlignment()->setHorizontal("center");
		// title set background
		$sheet->getStyle(1)->getFill()->setFillType(Fill::FILL_NONE)->getStartColor()->setARGB('ffffff');

		// header font changes
		$sheet->getStyle("A3:H3")->getFont()->setSize(12);
		$sheet->getStyle("A3:H3")->getFont()->getColor()->setARGB("ffffff");
		// header set background
		$sheet->getStyle("A3:H3")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

		$sheet->setCellValue('A1', 'Ginseng Star Report');

		$sheet->setCellValue('A3', 'User');
		$sheet->setCellValue('B3', 'FirstName');
		$sheet->setCellValue('C3', 'LastName');
		$sheet->setCellValue('D3', 'Email');
		$sheet->setCellValue('E3', 'Period');
		$sheet->setCellValue('F3', 'LeftBV');
		$sheet->setCellValue('G3', 'RightBV');
		$sheet->setCellValue('H3', 'Rank');

		$rows = 4;
		foreach ($report as $val) {
			// header set background
			$bgcolor = $rows % 2 == 1 ? 'c9c9c9' : 'ffffff';
			$sheet->getStyle("A" . $rows . ":H" . $rows)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($bgcolor);
			$sheet->getStyle("A" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("B" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("C" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("D" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("E" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("F" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("G" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("H" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));

			$sheet->setCellValue('A' . $rows, $val['userid']);
			$sheet->setCellValue('B' . $rows, $val['f_name']);
			$sheet->setCellValue('C' . $rows, $val['l_name']);
			$sheet->setCellValue('D' . $rows, $val['email']);
//			$arr = array(1, 2, 3, 4, 5, 6);
			$arr = array(1);
			foreach ($arr as $a) {
				$d = explode("__", $val['month' . $a]);
				$sheet->setCellValue('E' . $rows, $d[0]);
				$sheet->setCellValue('F' . $rows, $d[1]);
				$sheet->setCellValue('G' . $rows, $d[2]);
				$rnk = $val['rank' . $a];
				$rnk = $lang_model->replace("en", $rnk)['en'];
				$sheet->setCellValue('H' . $rows, $rnk);
				$rows++;
			}
		}
		$writer = new Xlsx($spreadsheet);
		$path = 'assets/exports/stars/' . getDownloadDate() . '.xlsx';
		$writer->save($path);
		return API_URL . $path;
	}

	public function membersheet($post)
	{
		$lang_model = $this->LanguageModel;
		$report = $this->MemberModel->exportAllMembers($post);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// set columns merge
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:I1');

		// set border
		$sheet->getStyle("A1:I1")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('0000ff'));

		// title font changes
		$sheet->getStyle(1)->getFont()->setBold(true);
		$sheet->getStyle(1)->getFont()->setSize(24);
		$sheet->getStyle(1)->getFont()->getColor()->setARGB("0000ff");
		$sheet->getStyle(1)->getAlignment()->setHorizontal("center");
		// title set background
		$sheet->getStyle(1)->getFill()->setFillType(Fill::FILL_NONE)->getStartColor()->setARGB('ffffff');

		// header font changes
		$sheet->getStyle("A3:I3")->getFont()->setSize(12);
		$sheet->getStyle("A3:I3")->getFont()->getColor()->setARGB("ffffff");
		// header set background
		$sheet->getStyle("A3:I3")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

		$sheet->setCellValue('A1', 'Ginseng Members Report');

		$sheet->setCellValue('A3', '#');
		$sheet->setCellValue('B3', 'WhatsApp');
		$sheet->setCellValue('C3', 'UserId');
		$sheet->setCellValue('D3', 'Name');
		$sheet->setCellValue('E3', 'Rank');
		$sheet->setCellValue('F3', 'Matrix');
		$sheet->setCellValue('G3', 'Sponsor');
		$sheet->setCellValue('H3', 'Package');
		$sheet->setCellValue('I3', 'Matrix Side');

		$rows = 4;
		$n = 1;
		foreach ($report as $val) {
			// header set background
			$bgcolor = $rows % 2 == 1 ? 'c9c9c9' : 'ffffff';
			$sheet->getStyle("A" . $rows . ":I" . $rows)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($bgcolor);
			$sheet->getStyle("A" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("B" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("C" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("D" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("E" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("F" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("G" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("H" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("I" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));

			$sheet->setCellValue('A' . $rows, $n++);
			$sheet->setCellValue('B' . $rows, $val['mobile']);
			$sheet->setCellValue('C' . $rows, $val['userid']);
			$sheet->setCellValue('D' . $rows, $val['f_name'] . " " . $val['l_name']);
			$rnk = $val['rank_name'];
			$rnk = $lang_model->replace("en", $rnk)['en'];
			$sheet->setCellValue('E' . $rows, $rnk);
			$sheet->setCellValue('F' . $rows, !empty($val['matrix_name']) ? $val['matrix_name'] : "N/A");
			$sheet->setCellValue('G' . $rows, !empty($val['sponsor_name']) ? $val['sponsor_name'] : "N/A");
			$sheet->setCellValue('H' . $rows, $val['package_name']);
			$sheet->setCellValue('I' . $rows, $val['matrix_side']);
			$rows++;
		}
		$writer = new Xlsx($spreadsheet);
		$path = 'assets/exports/members/' . getDownloadDate() . '.xlsx';
		$writer->save($path);
		return API_URL . $path;
	}

	public function summarysheet($post)
	{
      	$reports = $this->ReportModel->getSummary($post['period']);
     
      	$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// set columns merge
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:B1');

		// set border
		$sheet->getStyle("A1:B1")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('0000ff'));

		// title font changes
		$sheet->getStyle(1)->getFont()->setBold(true);
		$sheet->getStyle(1)->getFont()->setSize(24);
		$sheet->getStyle(1)->getFont()->getColor()->setARGB("0000ff");
		$sheet->getStyle(1)->getAlignment()->setHorizontal("center");
		// title set background
		$sheet->getStyle(1)->getFill()->setFillType(Fill::FILL_NONE)->getStartColor()->setARGB('ffffff');

		// header font changes
		$sheet->getStyle("A3:B3")->getFont()->setSize(12);
		$sheet->getStyle("A3:B3")->getFont()->getColor()->setARGB("ffffff");
		// header set background
		$sheet->getStyle("A3:B3")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

		$sheet->setCellValue('A1', 'Ginseng Summary Report - ' . $post['period']);

		$sheet->setCellValue('A3', '#');
		$sheet->setCellValue('B3', 'Amount');
		
        $sheet->getStyle("A4:B4")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("c9c9c9");
        $sheet->getStyle("A4")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->getStyle("B4")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->setCellValue('A4', "[[COM_TOTAL_MEMBERS]]");
        $sheet->setCellValue('B4', $reports['main_members']);

        $sheet->getStyle("A4:B5")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("fff");
        $sheet->getStyle("A5")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->getStyle("B5")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->setCellValue('A5', "[[COM_TOTAL_NODES]]");
        $sheet->setCellValue('B5', $reports['members']);
		
        $sheet->getStyle("A6:B6")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("c9c9c9");
        $sheet->getStyle("A6")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->getStyle("B6")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->setCellValue('A6', "[[COM_TOTAL_SALES]]");
        $sheet->setCellValue('B6', $reports['sales']);

        $sheet->getStyle("A7:B7")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB("fff");
        $sheet->getStyle("A7")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->getStyle("B7")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
        $sheet->setCellValue('A7', "[[COM_TOTAL_SALES_IN]]");
        $sheet->setCellValue('B7', $reports['period_sales']);
	
		$rows = 8;
		$n = 1;
		foreach ($reports['ledgers'] as $ledger) {
			// header set background
			$bgcolor = $rows % 2 == 1 ? 'c9c9c9' : 'ffffff';
			$sheet->getStyle("A" . $rows . ":B" . $rows)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($bgcolor);
			$sheet->getStyle("A" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("B" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));

			$sheet->setCellValue('A' . $rows, "[[" . preg_replace("/[\s-]/", "_", $ledger['trans_source_type']) . "]] (" . $ledger['currency'] . ")" );
			$sheet->setCellValue('B' . $rows, ($ledger['dr'] == 0 ? $ledger['cr'] : $ledger['dr']));
			$rows++;
		}
		$writer = new Xlsx($spreadsheet);
		$path = 'assets/exports/summary/' . getDownloadDate() . '.xlsx';
		$writer->save($path);
		return API_URL . $path;
	}

	public function ordersheet($post)
	{
		$report = $this->OrderModel->exportAllOrders($post);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// set columns merge
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:K1');

		// set border
		$sheet->getStyle("A1:K1")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('0000ff'));

		// title font changes
		$sheet->getStyle(1)->getFont()->setBold(true);
		$sheet->getStyle(1)->getFont()->setSize(24);
		$sheet->getStyle(1)->getFont()->getColor()->setARGB("0000ff");
		$sheet->getStyle(1)->getAlignment()->setHorizontal("center");
		// title set background
		$sheet->getStyle(1)->getFill()->setFillType(Fill::FILL_NONE)->getStartColor()->setARGB('ffffff');

		// header font changes
		$sheet->getStyle("A3:K3")->getFont()->setSize(12);
		$sheet->getStyle("A3:K3")->getFont()->getColor()->setARGB("ffffff");
		// header set background
		$sheet->getStyle("A3:K3")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

		$sheet->setCellValue('A1', 'Ginseng Members Report');

		$sheet->setCellValue('A3', '#');
		$sheet->setCellValue('B3', 'Action');
		$sheet->setCellValue('C3', 'OrderDate');
		$sheet->setCellValue('D3', 'RejectionDate');
		$sheet->setCellValue('E3', 'ApprovalDate');
		$sheet->setCellValue('F3', 'DeliverDate');
		$sheet->setCellValue('G3', 'OrderBy');
		$sheet->setCellValue('H3', 'OrderNumber');
		$sheet->setCellValue('I3', 'Type');
		$sheet->setCellValue('J3', 'Amount');
		$sheet->setCellValue('K3', 'Payment');

		$rows = 4;
		$n = 1;
		foreach ($report as $val) {
			// header set background
			$bgcolor = $rows % 2 == 1 ? 'c9c9c9' : 'ffffff';
			$sheet->getStyle("A" . $rows . ":K" . $rows)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($bgcolor);
			$sheet->getStyle("A" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("B" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("C" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("D" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("E" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("F" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("G" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("H" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("I" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("J" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("K" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));

			$sheet->setCellValue('A' . $rows, $n++);
			$sheet->setCellValue('B' . $rows, $val['status']);
			$sheet->setCellValue('C' . $rows, $val['order_date']);
			$sheet->setCellValue('D' . $rows, $val['rejected_date']);
			$sheet->setCellValue('E' . $rows, $val['approved_date']);
			$sheet->setCellValue('F' . $rows, $val['received_date']);
			$sheet->setCellValue('G' . $rows, $val['userid'] . "(" . $val['f_name'] . " " . $val['l_name'] . ")");
			$sheet->setCellValue('H' . $rows, $val['order_num']);
			$sheet->setCellValue('I' . $rows, $val['order_type']);
			$sheet->setCellValue('J' . $rows, $val['total_amount']);
			$sheet->setCellValue('K' . $rows, $val['payment_type']);
			$rows++;
		}
		$writer = new Xlsx($spreadsheet);
		$path = 'assets/exports/orders/' . getDownloadDate() . '.xlsx';
		$writer->save($path);
		return API_URL . $path;
	}

	public function ledgersheet($post)
	{
      	if($post['type'] == 'sales'){
        	$this->salessheet($post);
          	exit;
        }
		$lang_model = $this->LanguageModel;
		$report = $this->LedgerModel->exportUniversalLedger($post);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// set columns merge
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:G1');

		// set border
		$sheet->getStyle("A1:G1")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('0000ff'));

		// title font changes
		$sheet->getStyle(1)->getFont()->setBold(true);
		$sheet->getStyle(1)->getFont()->setSize(24);
		$sheet->getStyle(1)->getFont()->getColor()->setARGB("0000ff");
		$sheet->getStyle(1)->getAlignment()->setHorizontal("center");
		// title set background
		$sheet->getStyle(1)->getFill()->setFillType(Fill::FILL_NONE)->getStartColor()->setARGB('ffffff');

		// header font changes
		$sheet->getStyle("A3:G3")->getFont()->setSize(12);
		$sheet->getStyle("A3:G3")->getFont()->getColor()->setARGB("ffffff");
		// header set background
		$sheet->getStyle("A3:G3")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

		$sheet->setCellValue('A1', 'Ginseng ' . ucfirst($post['type']) . ' Report');

		$sheet->setCellValue('A3', '#');
		$sheet->setCellValue('B3', 'UserId');
		$sheet->setCellValue('C3', 'Date');
		$sheet->setCellValue('D3', 'Description');
		$sheet->setCellValue('E3', 'Credit');
		$sheet->setCellValue('F3', 'Debit');
		$sheet->setCellValue('G3', 'Total');

		$rows = 4;
		$n = 1;
		foreach ($report as $val) {
			// header set background
			$bgcolor = $rows % 2 == 1 ? 'c9c9c9' : 'ffffff';
			$sheet->getStyle("A" . $rows . ":G" . $rows)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($bgcolor);
			$sheet->getStyle("A" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("B" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("C" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("D" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("E" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("F" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("G" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));

			$sheet->setCellValue('A' . $rows, $n++);
			$sheet->setCellValue('B' . $rows, $val['userid']);
			$sheet->setCellValue('C' . $rows, $val['insert_time']);
			$description = $val['description'];
			$trans = $lang_model->replace("en", $description);
			$description = isset($trans['en']) ? $trans['en'] : $val['description'];
			$sheet->setCellValue('D' . $rows, $description);
			$sheet->setCellValue('E' . $rows, $val['credit']);
			$sheet->setCellValue('F' . $rows, $val['debit']);
			$sheet->setCellValue('G' . $rows, $val['balance']);
			$rows++;
		}
		$writer = new Xlsx($spreadsheet);
		$dir = 'assets/exports/ledgers/' . $post['type'];
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		$path = $dir . '/' . getDownloadDate() . '.xlsx';
		$writer->save($path);
		return API_URL . $path;
	}

	public function salessheet($post)
	{
		$lang_model = $this->LanguageModel;
		$report = $this->LedgerModel->exportUniversalLedger($post);

		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		// set columns merge
		$spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:G1');

		// set border
		$sheet->getStyle("A1:G1")->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THICK)->setColor(new Color('0000ff'));

		// title font changes
		$sheet->getStyle(1)->getFont()->setBold(true);
		$sheet->getStyle(1)->getFont()->setSize(24);
		$sheet->getStyle(1)->getFont()->getColor()->setARGB("0000ff");
		$sheet->getStyle(1)->getAlignment()->setHorizontal("center");
		// title set background
		$sheet->getStyle(1)->getFill()->setFillType(Fill::FILL_NONE)->getStartColor()->setARGB('ffffff');

		// header font changes
		$sheet->getStyle("A3:G3")->getFont()->setSize(12);
		$sheet->getStyle("A3:G3")->getFont()->getColor()->setARGB("ffffff");
		// header set background
		$sheet->getStyle("A3:G3")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('0000ff');

		$sheet->setCellValue('A1', 'Ginseng ' . ucfirst($post['type']) . ' Report');

		$sheet->setCellValue('A3', '#');
		$sheet->setCellValue('B3', 'UserId');
		$sheet->setCellValue('C3', 'Date');
		$sheet->setCellValue('D3', 'Description');
		$sheet->setCellValue('E3', 'Credit');
		$sheet->setCellValue('F3', 'Debit');
		$sheet->setCellValue('G3', 'Total');

		$rows = 4;
		$n = 1;
		foreach ($report as $val) {
			// header set background
			$bgcolor = $rows % 2 == 1 ? 'c9c9c9' : 'ffffff';
			$sheet->getStyle("A" . $rows . ":G" . $rows)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($bgcolor);
			$sheet->getStyle("A" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("B" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("C" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("D" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("E" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("F" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));
			$sheet->getStyle("G" . $rows)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('000'));

			$sheet->setCellValue('A' . $rows, $n++);
			$sheet->setCellValue('B' . $rows, $val['userid']);
			$sheet->setCellValue('C' . $rows, $val['insert_time']);
			$description = $val['description'];
			$trans = $lang_model->replace("en", $description);
			$description = isset($trans['en']) ? $trans['en'] : $val['description'];
			$sheet->setCellValue('D' . $rows, $description);
			$sheet->setCellValue('E' . $rows, $val['credit']);
			$sheet->setCellValue('F' . $rows, $val['debit']);
			$sheet->setCellValue('G' . $rows, $val['balance']);
			$rows++;
		}
		$writer = new Xlsx($spreadsheet);
		$dir = 'assets/exports/ledgers/' . $post['type'];
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		$path = $dir . '/' . getDownloadDate() . '.xlsx';
		$writer->save($path);
		return API_URL . $path;
	}

	public function commissionSheet()
	{
		$data = $this->CommissionModel->getAllMembaers();
		$file = fopen('commission.csv', 'w');
		// Write the header to the CSV file
		fputcsv($file, array('UserId', 'Name','Total Sales','Total Comission','Sponsor Bonus','Binary Bonus','Matching Bonus','CC Balance','RC Balance','Total E-Wallet Balnce'));

		foreach ($data as $key => $value) {
			$wallet = $this->CommissionModel->getBalance("", $value->id);
			$ccBalance = $this->CommissionModel->getBalance("CC", $value->id);
			$rcBalance = $this->CommissionModel->getBalance("RC", $value->id);
			$name = $value->f_name .' ' . $value->l_name;
			fputcsv($file, array(
				$value->userid,
				$name, 
				$this->SaleModel->getTotalMemberSales($value->id),
				$this->CommissionModel->getTotleComissionByMemberId($value->id),
				$this->CommissionModel->getSponsorBonus($value->id),
				$this->CommissionModel->getBinaryBonus($value->id),
				$this->CommissionModel->getMatchingBonus($value->id),
				$ccBalance['available_balance']['balance'] ?? '',
				$rcBalance['available_balance']['balance'] ?? '',
				$wallet['available_balance']['balance'] ?? '',
			));
		}
		fclose($file);
		header('Content-Type: application/csv');
		header('Content-Disposition: attachment; filename="commission.csv"');
		readfile('commission.csv');
		exit;
	}

}

