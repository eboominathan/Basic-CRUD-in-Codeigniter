<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login/student_model');
		$this->load->helper('url');
		
	}	
	
	//Shows the dashboard
	public function index()
	{
		if($this->session->userdata('is_logged_in'))
		{

			$this->load->view('header');
			$this->load->view('student');
			$this->load->view('login/footer');
		}else{
			$this->load->view('login/header');
			$this->load->view('login/content'); 
			$this->load->view('login/footer');
		}
	}
	//Insert the Student 
	public function  insert_student()
	{
		$interest=implode(',',$this->input->post('interest'));
		$data=array('name'=>$this->input->post('name'),
			'address'=>$this->input->post('address'),
			'year'=>$this->input->post('year'),
			'gender'=>$this->input->post('gender'),
			'interest'=>$interest,
			'status'=>1);
		
		
		$result=$this->student_model->insert_student($data);
		if($result==true)
		{
			$this->session->set_flashdata('msg',"Student Records Added Successfully");
			redirect('student');

		}
		else
		{

			$this->seesion->set_flashdata('msg1',"Student Records Added Failed");
			redirect('student');


		}
	}
	//List of students 
	public function list_students()
	{
		if($this->session->userdata('is_logged_in'))
		{

			$data['student']=$this->student_model->get_student();

			$this->load->view('header',array('error' => ' ' ));
			$this->load->view('list_of_students',$data);
			$this->load->view('login/footer');
		}
		else{
			$this->load->view('login/header');
			$this->load->view('login/content'); 
			$this->load->view('login/footer');
		}
	}

	//Change the Status of student to hide fron the table 

	public function delete_student()
	{
		$id=$this->input->post('id');
		$data=array('status'=>0);
		$result=$this->student_model->delete_student($id,$data);
		if($result==true)
		{
			$this->session->set_flashdata('msg1',"Deleted Successfully");
			redirect('student/list_students');

		}
		else
		{

			$this->session->set_flashdata('msg1',"Student Records Deletion Failed");
			redirect('student/list_students');


		}

	}
	//View the Edit page 
	public function edit_student()
	{
		$id=$this->uri->segment(3);
		$data['student']=$this->student_model->edit_student($id);
		$this->load->view('header',$data);
		$this->load->view('edit_student');
	}

	//Update Student

	public function  update_student()
	{
		$id=$this->input->post('id');
		$interest=implode(',',$this->input->post('interest'));
		$data=array('name'=>$this->input->post('name'),
			'address'=>$this->input->post('address'),
			'year'=>$this->input->post('year'),
			'gender'=>$this->input->post('gender'),
			'interest'=>$interest,
			'status'=>1);

		$result=$this->student_model->update_student($data,$id);
		if($result==true)
		{
			$this->session->set_flashdata('msg',"Student Records Updated Successfully");
			redirect('student/list_students');

		}
		else
		{

			$this->session->set_flashdata('msg1',"No changes Made in Student Records");
			redirect('student/list_students');


		}
	}

	// Export as Word 
	Public function word()
	{

			$student=$this->student_model->get_student();
		header("Content-type: application/vnd.ms-word");
		header("Content-Disposition: attachment;Filename=document_name.doc");

$html="<html>
 	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
 	<body>";



$data='<table class="table table-bordered" id="table"> 
<thead>
<tr>
	<th style="text-align:center;  background-color:#4C9ED9; color: #fff;">S.NO</th>
	<th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Name</th>
    <th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Address</th>  
    <th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Gender</th> 
    <th style="text-align:center;  background-color:#4C9ED9; color: #fff;">Year of Passing</th>  

	</tr>
</thead>
<tr>';
		 $i=1;
 foreach($student as $s ):
$data .='<td style="text-align:center;" >'.$i++.'</td>
<td style="text-align:center;">'.$s->name.'</td>
<td style="text-align:center;">'.$s->address.'</td>
<td style="text-align:center;">'.$s->gender.'</td>
<td style="text-align:center;">'.$s->year.'</td>
</tr>';
 endforeach ;
$data .='</table>';
echo  $html.$data;
	}



	//To Generate  the Pdf Report
	public function pdf()
	{
		$this->load->library('mpdf');
		$data['student']=$this->student_model->get_student();
		$this->load->view('pdf',$data);
	}


	//To generate the Excel Report
	Public function Excel()
	{
		date_default_timezone_set('Asia/calcutta');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Student');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Excel Sheet Generated! Happy to help!!');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Name');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Year of Passing');


        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table data
		$sql = "SELECT name,address,gender,year from student_list where status = 1";        
		$rs = $this->db->query($sql);
//        $rs = $this->db->get('countries');
		$exceldata="";
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $filename='Student_List-'.date('d/m/y').'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');


            }

            public function upload_excel()
            {


			//upload folder path defined here 

            	$config['upload_path'] =  './upload/';

			//Only allow this type of extensions 
            	$config['allowed_types'] = 'xlsx|csv';

            	$this->load->library('upload', $config);

			// if any error occurs 

            	if ( ! $this->upload->do_upload('userfile'))
            	{
            		$error = array('error' => $this->upload->display_errors());


            		$data['student']=$this->student_model->get_student();
            		$this->load->view('header',$data);
            		$this->load->view('list_of_students', $error);
            		$this->load->view('login/footer');
            	}
		//if successfully uploaded the file 
            	else
            	{
            		$upload_data = $this->upload->data();
            		$file_name = $upload_data['file_name'];


			//load library phpExcel
            		$this->load->library("Excel");


		//here i used microsoft excel 2007
            		$objReader = PHPExcel_IOFactory::createReader('Excel2007');

		//set to read only
            		$objReader->setReadDataOnly(true);
		//load excel file
            		$objPHPExcel = $objReader->load('upload/'.$file_name);
            		$sheetnumber = 0;
            		foreach ($objPHPExcel->getWorksheetIterator() as $sheet)
            		{

		$s = $sheet->getTitle();	// get the sheet name 

		$sheet= str_replace(' ', '', $s); // remove the spaces between sheet name 
		$sheet= strtolower($sheet); 
		$objWorksheet = $objPHPExcel->getSheetByName($s);

		$lastRow = $objPHPExcel->setActiveSheetIndex($sheetnumber)->getHighestRow(); 
		$sheetnumber++;
		
		if($sheet=='student')// if sheet name is student 
		{
		//loop from first data until last data
			for($j=2; $j<=$lastRow; $j++)
			{


				$name = $objWorksheet->getCellByColumnAndRow(1,$j)->getValue();
				$address = $objWorksheet->getCellByColumnAndRow(2,$j)->getValue();
				$year = $objWorksheet->getCellByColumnAndRow(3,$j)->getValue();
				$gender = $objWorksheet->getCellByColumnAndRow(4,$j)->getValue();

				if($name != '' || $address != ''|| $year != ''|| $gender != '')
				{

					
					$excel = array(
						'name'=>$name,
						'address'=>$address,
						'year'=>$year,
						'gender'=>$gender,
						'status'=>1);
					$this->db->insert('student_list',$excel);
					$result=($this->db->affected_rows()!= 1)? false:true;
					if($result == true)
					{

						$this->session->set_flashdata('msg', 'Student Details Uploaded Successfully');
						redirect('student/list_students');
					}
					else
					{
						$this->session->set_flashdata('msg1', 'Student Details Uploading Failed');
						redirect('student/list_students');
					}

					
				}
				else
				{
					$this->session->set_flashdata('msg1', 'Failed To Upload!Contents are not Matched');
					redirect('student/list_students');
				}		
				}// loop ends 



			}

		}
	}

}


}
?>
