<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homec extends CI_Controller {
    public function index(){
        $this->load->view('homepage');
    }
    
   

    public function lcheck(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        if($username==$password)
        {
        echo "connected";
        $volmob=$this->db->query("select * from `voltable` where `mobno`=$username")->row(); 
       
        if($volmob->level="STATE OFFICE INCHARGE" || $volmob->level="DISTRICT PRACHARAK")
        {
              $_SESSION['admin']=$volmob->level;
            if(isset($_SESSION['admin'])){
             redirect(base_url().'home');

        }
        else{
            echo "ERROR IN CREATING SESSION";
        }
    }   
    }
    } 
    public function logout(){
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
            redirect(base_url().'index');
            }
        }

    public function Home(){
        if(isset($_SESSION['admin'])){
        $this->load->view('home');
        }
    }

    public function adddharmapracharak(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view(base_url().'adddharmapracharak',$data);
        }
    }

    public function dharmapracharak(){
        if(isset($_SESSION['admin'])){
        $statedata=$this->input->post('state');
        $districtdata=$this->input->post('district');
        $divisiondata=$this->input->post('division');
        $mandaldata=$this->input->post('mandal');
        $village=$this->input->post('village');
        $state=explode("|-|",$statedata);
        $district=explode("|-|",$districtdata);
        $division=explode("|-|",$divisiondata);
        $mandal=explode("|-|",$mandaldata);
        $village=explode("|-|",$village);
        $volid=$this->db->query("select max(`volid`+1) as `id` from `voltable`")->row();
        $data=array(
            "state"=>$state[0],
            "sname1"=>$state[1],
            "district"=>$district[0],
            "dname1"=>$district[1],
            "division"=>$division[0],
            "divname1"=>$division[1],
            "mandal"=>$mandal[0],
            "mname1"=>$mandal[1],
            "village"=>$village[0],
            "vname1"=>$village[1],
            "vname"=>$this->input->post('name'),
            "volid"=>$volid->id,
            "gender"=>$this->input->post('gender-select'),
            "qualifications"=>$this->input->post('qualification'),
            "mobno"=>$this->input->post('number'),
            "dno"=>$this->input->post("drno"),
            "pincode"=>$this->input->post("pincode"),
            "street"=>$this->input->post("street"),
            "level"=>$this->input->post("levels"),
            "skills"=>$this->input->post("skills"),

        );
        if($this->db->insert('voltable',$data)){
            redirect(base_url().'adddharmapracharak');
        }   
    }
}

    public function addviewdharmapracharakactivitymapping(){
        if(isset($_SESSION['admin'])){
        $data['volunteers']=$this->db->get('voltable')->result();
        $this->load->view('addViewDharmaPracharakActivityMapping',$data);
        }
    }


    public function vieweditdharmapracharak(){
        if(isset($_SESSION['admin'])){
        $data['volunteers']=$this->db->get('voltable')->result();
        $this->load->view('viewEditDharmaPracharak',$data);
        }
    }


    public function viewdharmapracharakbyactivity(){
        if(isset($_SESSION['admin'])){
        $data['volunteers']=$this->db->get('voltable')->result();
        $this->load->view('viewDharmaPracharakByActivity',$data);
        }
    }


    public function viewdharmapracharakbylevel(){
        if(isset($_SESSION['admin'])){
        $data['volunteers']=$this->db->get('voltable')->result();
        $this->load->view('viewDharmaPracharakByLevel',$data);
        }
    }


    public function volunteerAssignment(){
        if(isset($_SESSION['admin'])){
        $this->load->view('volunteerAssignment');
        }
    }


    public function viewvolunteertask(){
        if(isset($_SESSION['admin'])){
        $this->load->view('viewVolunteerTask');
        }
    }


    public function addedittemple(){
        if(isset($_SESSION['admin'])){
            $data['states']=$this->db->get('stable')->result();
        $this->load->view('addEditTemple',$data);
        }
    } 
   public function edittemple(){
        if(isset($_SESSION['admin'])){
            $data['states']=$this->db->get('stable')->result();
        $this->load->view('editTemple',$data);
        }
    }
   public function deletetemple(){
        if(isset($_SESSION['admin'])){
            $data['states']=$this->db->get('stable')->result();
        $this->load->view('deleteTemple',$data);
        }
    }  
    public function addtotemple(){
        if(isset($_SESSION['admin'])){
        $statedata=$this->input->post('state');
        $districtdata=$this->input->post('district');
        $divisiondata=$this->input->post('division');
        $mandaldata=$this->input->post('mandal');
        $village=$this->input->post('village');
        $state=explode("|-|",$statedata);
        $district=explode("|-|",$districtdata);
        $division=explode("|-|",$divisiondata);
        $mandal=explode("|-|",$mandaldata);
        $village=explode("|-|",$village);
        $templeid=$this->db->query("select max(`tid`+1) as `id` from `temple`")->row();
        $data=array(
            "tempname"=>$this->input->post('temple'),
            "tid"=>$templeid->id,
            "state"=>$state[0],
            "sname"=>$state[1],
            "district"=>$district[0],
            "dname"=>$district[1],
            "division"=>$division[0],
            "divname"=>$division[1],
            "mandal"=>$mandal[0],
            "mname"=>$mandal[1],
            "village"=>$village[0],
            "vname"=>$village[1],
            "pincode"=>$this->input->post("pincode"),
            "committe"=>$this->input->post("templecommitte"),
            "acno"=>$this->input->post("accountno"),
            "verification"=>$this->input->post("verification"),
            "supervisor"=>$this->input->post("supervision"),
            "area"=>$this->input->post("area"),
            "GNDT"=>$this->input->post("grandtotal"),
        );
        if($this->db->insert('temple',$data))
        {
            $folder= $this->db->get_where("temple",array("tid"=>$templeid->id))->row()->tid;
            if(is_numeric($folder))
            {
                

                if(mkdir("./assets/temples/".$folder))
                {
                    if(mkdir("./assets/temples/".$folder."/documents"))
                        redirect(base_url().'/addedittemple');
                }
            }
        }
    }
    }

    public function addtemplepaymentstatus(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('addTemplePaymentStatus',$data);
        }
    }


    public function viewtemplepaymentstatus(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('viewTemplePaymentStatus',$data);
        }
    }


    public function uploadtempledocuments(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('uploadTempleDocuments',$data);
        }
    }

    public function uploadtotempledocuments()
	{
    if(isset($_SESSION['admin'])){
	    if( !empty($_FILES['files']['name'])){
			$flag=0;
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
				echo $filesCount;
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                $templedata=$this->input->post('temple');
                $temple=explode("|-|",$templedata);
                $config['upload_path']   ="./assets/temples/".$temple[0]."/documents/";         
                $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|docx';
		
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('file')){
					
					echo "not";
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
					$uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
					
				}
				else{
					echo "err";
				}
			
			}
			if($flag > 0)
			{
				$this->load->helper("url");
				redirect("Admin/editimages");
			} 
		}
	}
    }

    public function viewtempledocuments(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('viewTempleDocuments',$data);
        }
    }


    public function uploadpaymentdocuments(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('uploadPaymentDocuments',$data);
        }
    }


    public function viewpaymentdocuments(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('viewPaymentDocuments',$data);
        }
    }


    public function viewalltempleimages(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('viewAllTempleImages',$data);
        }
    }


   public function dispalytempleimages()
   {
       if(isset($_SESSION['admin']))
       {
          $statedata=$this->input->post('state');
          $districtdata=$this->input->post('district');
          $divisiondata=$this->input->post('division');
          $mandaldata=$this->input->post('mandal');
          $village=$this->input->post('village');
          $village=$this->input->post('temple');
          $data['states']=$this->db->get('stable')->result();
          $this->load->view('dispalyTempleImages',$data);  
       }
   }

    public function viewalltemples(){
        if(isset($_SESSION['admin'])){
        $data['temples']=$this->db->get('temple')->result();
        $this->load->view('viewAllTemples',$data);
        }
    }


    public function viewtemplestatus(){
        if(isset($_SESSION['admin'])){
        $data['temples']=$this->db->get('temple')->result();
        $this->load->view('viewTempleStatus',$data);
        }
    }

    public function templeschedule(){
        if(isset($_SESSION['admin'])){
        $this->load->view('templeSchedule');
        }
    }
    public function addarchaka(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('addArchaka',$data);
        }
    }
    public function viewarchaka(){
        if(isset($_SESSION['admin'])){
        $data['archaka']=$this->db->get('archaka')->result();
        $this->load->view('viewArchaka',$data);
        }
    }
    public function uploadtempleprograms(){
        if(isset($_SESSION['admin'])){
        $this->load->view('uploadTemplePrograms');
        }
    }
    public function divyadharshan(){
        if(isset($_SESSION['admin'])){
        $this->load->view('divyadharshan');
        }
    }

    public function addstate(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $this->load->view('addState',$data);
        }
    }

    public function adddistrict(){
        if(isset($_SESSION['admin'])){
        $data["states"]=$this->db->get("stable")->result();
        $data['districts']=$this->db->get('dtable')->result();
        $this->load->view('addDistrict',$data);
        }
    }

    public function addtodistrict(){
        if(isset($_SESSION['admin'])){
        $statedata=$this->input->post('sname');
        $district=$this->input->post('district');
        $state=explode("|-|",$statedata);
        $stateid=$state[0];
        $statename=$state[1];
        $districtid=$this->db->query("select max(did+1) as id from dtable")->row();
        $data=array(
            'did'=>$districtid->id,
             "sid"=>$stateid,
             "sname"=>$statename,
             "dname"=>$district,
             "cid"=>1,
        );
        if($this->db->insert('dtable',$data))
        {
            redirect(base_url().'/adddistrict');
        }
    }
}


    public function adddivision(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $data['divisions']=$this->db->get('divtable')->result();
        $this->load->view('addDivision',$data);
        }
    } 

    public function addtodivision(){
        if(isset($_SESSION['admin'])){
        $statedata=$this->input->post('state');
        $districtdata=$this->input->post('district');
        $division=$this->input->post('division');
        $state=explode("|-|",$statedata);
        $district=explode("|-|",$districtdata);
        $divisionid=$this->db->query("select max(divid+1) as id from divtable")->row();
        $data=array(
            "did"=>$district[0],
             "sid"=>$state[0],
             "sname"=>$state[1],
             "dname"=>$district[1],
              "divid"=>$divisionid->id,
              "divname"=>$division,
             "cid"=>"1",
        );
        if($this->db->insert('divtable',$data))
        {
            redirect(base_url().'/adddivision');
        }
    }
}


    public function addmandal(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $data['mandals']=$this->db->get('mtable')->result();
        $this->load->view('addMandal',$data);
        }
    }

    public function addtomandal(){
        if(isset($_SESSION['admin'])){
        $statedata=$this->input->post('state');
        $districtdata=$this->input->post('district');
        $divisiondata=$this->input->post('division');
        $mandal=$this->input->post('mandal');
        $state=explode("|-|",$statedata);
        $district=explode("|-|",$districtdata);
        $division=explode("|-|",$divisiondata);
        $mandalid=$this->db->query("select max(mid+1) as id from mtable")->row();
        $data=array(
            "did"=>$district[0],
             "sid"=>$state[0],
             "sname"=>$state[1],
             "dname"=>$district[1],
              "divid"=>$division[0],
              "divname"=>$division[1],
              "mid"=>$mandalid->id,
              "mname"=>$mandal,
             "cid"=>"1",

        );
        if($this->db->insert('mtable',$data))
        {
            redirect(base_url().'/addmandal');
        }
    }
}


    public function addvillage(){
        if(isset($_SESSION['admin'])){
        $data['states']=$this->db->get('stable')->result();
        $data['villages']=$this->db->get('vtable')->result();
        $this->load->view('addVillage',$data);
        }
    }

    public function addtovillage(){
        if(isset($_SESSION['admin'])){
        $statedata=$this->input->post('state');
        $districtdata=$this->input->post('district');
        $divisiondata=$this->input->post('division');
        $mandaldata=$this->input->post('mandal');
        $village=$this->input->post('village');
        $state=explode("|-|",$statedata);
        $district=explode("|-|",$districtdata);
        $division=explode("|-|",$divisiondata);
        $mandal=explode("|-|",$mandaldata);
        $villageid=$this->db->query("select max(vid+1) as id from vtable")->row();
        $data=array(
            "did"=>$district[0],
             "sid"=>$state[0],
             "sname"=>$state[1],
             "dname"=>$district[1],
              "divid"=>$division[0],
              "divname"=>$division[1],
              "mid"=>$mandal[0],
              "mname"=>$mandal[1],
              "vname"=>$village,
              "vid"=>$villageid->id,
             "cid"=>"1",

        );
        if($this->db->insert('vtable',$data))
        {
            redirect(base_url().'/addvillage');
        } 

    }
}

    public function addactivity(){
        if(isset($_SESSION['admin'])){
        $this->load->view('addActivity');
        }
    }
    public function adduser(){
        if(isset($_SESSION['admin'])){
        $this->load->view('addUser');
        }
    }
    public function modifyuser(){
        if(isset($_SESSION['admin'])){
        $this->load->view('modifyUser');
        }
    }
    public function changepassword(){
        if(isset($_SESSION['admin'])){
        $this->load->view('changePassword');
        }
    }


    public function reports(){
        if(isset($_SESSION['admin'])){
        $this->load->view('reports');
        }
    }


    public function sharelink(){
        if(isset($_SESSION['admin'])){
        $data['districts']=$this->db->get('dtable')->result();
        $this->load->view('sharelink',$data);
        }
    }

    public function uploadlink(){
        if(isset($_SESSION['admin'])){
        $districtdata=$this->input->post('district');
        $ptype=$this->input->post('ptype');
        $year=$this->input->post('year');
        $link=$this->input->post('link');
        $district=explode("|-|",$districtdata);
        $check=$this->db->insert('gslinks',array('district'=>$district[1],
        'type'=>$ptype,
        'year'=>$year,
        'link'=>$link));
        if($check){
            redirect(base_url().'/sharelink');
        }
    }
    }

    
    public function getlink(){
        if(isset($_SESSION['admin'])){
        $data['districts']=$this->db->get('dtable')->result();
        $this->load->view('getlink',$data);
        }
    }

public function jsontemple(){
        //if(isset($_SESSION['admin'])){
        $data['templeres']=$this->db->get('temple')->result();
        $this->load->view('jsontemple2',$data);
        
        //}
    }


public function loginverify()
{
   $volmobileno=$this->input->post('t1');     
   //echo "connected".$volmobileno;
   if($volmobileno)
    {
      $volmob=$this->db->query("select * from `voltable` where `mobno`='$volmobileno'")->row(); 
      if($volmob)
      {      
                   $volid=$volmob->volid;
		   $vname=$volmob->vname;
		   $mobno=$volmob->mobno;
                   echo json_encode(array('status' => 'success','volid' => $volid,'vname' => $vname,'mobno' => $mobno));
      }
      else
      {
          echo json_encode(array('status' => 'fail'));
      }   
    }
}


public function savegps()
{
   $volid=$this->input->post('vid');
   $volname=$this->input->post('vname1');
   $volmobileno=$this->input->post('mobno1'); 
   $longitude=$this->input->post('lng1'); 
   $latitude=$this->input->post('lat1');
   $templeid=$this->input->post('sub1');    
   



  //echo "connected".$volmobileno;
   if($volmobileno && $longitude && $latitude)
    {

/*       //echo "Enter";
      $volmob=$this->db->query("update `temple` set `longitude`='$longitude', `latitude`='$latitude',`vid`=$volid,`volname`='$volname',`vmob`='$volmobileno' WHERE tid=$templeid");
*/
$data = array(
 'longitude' => $longitude,
 'latitude' => $latitude,
 'vid'=>$volid,
 'volname'=>$volname,
 'vmob'=>$volmobileno
 );
$this->db->set($data);
$this->db->where('tid', $templeid);
$this->db->update('temple');
       echo "hai";

    }
}

public function file_upload()
{

    // key name is file_name
       
       if (!empty($_FILES)) 
       {
           $templeid=$this->input->post('sub1');
           $uploads_path='assets/temples/'.$templeid.'/';
           $config['upload_path'] = $uploads_path;
           $config['allowed_types'] = 'gif|jpg|png|jpeg';
          
           $config['overwrite'] = FALSE;
           $config['encrypt_name'] = TRUE;
           $config['remove_spaces'] = TRUE;
           $this->load->library('upload', $config);
           if (!$this->upload->do_upload('uploadedfile')) 
            {
               $this->data['error'] = array('error' => $this->upload->display_errors());
               $arr = array('status' => "invalid", "message" => strip_tags($this->data['error']["error"]), "title" => "invalid", "error" => strip_tags($this->data['error']));
           } 
           else 
           {
               $data = array('upload_data' => $this->upload->data());
               $file_name = $data["upload_data"]["file_name"];
               $arr = array('status' => "valid", "message" => "Image Uploaded","file_name" => $file_name, "file_path" => $this->base.$file_name);

               $data1 = array('tid' => $templeid,'imgpath'=>'http://samarastasewa.pscmrcetonline.com/'.$uploads_path.$file_name);
               $this->db->set($data1);
               $this->db->where('tid', $templeid);
               $this->db->update('temple');

           }
           echo json_encode($arr);
       }









}

    public function dropdowndata()
	{
        if(isset($_SESSION['admin'])){   
		$this->load->database();
		if($this->input->post("state"))
		{
			$pro0=$this->db->get_where("dtable",array("sid"=>$this->input->post("state")))->result();
			$option="<option value=''>---add District---</option>";
			foreach($pro0 as $prodata)
			{
				$option=$option."<option value='$prodata->did|-|$prodata->dname'>$prodata->dname</option>";
			}
			echo $option;
		}

		if($this->input->post("nagaramu"))
		{
			$option="<option value=''>--Choose basti --</option>";
			$string=$this->input->post("nagaramu");
			if($string!="")
			{
				$data=$this->db->get_where("basti",array("nid"=>$string,"brid"=>$this->session->brid))->result();
				foreach($data as $result)
				{
					$option= $option."<option value='$result->id|-|$result->basti'>$result->basti</option>";
				}
			}
			echo $option;
		}
		
        
        if($this->input->post("village"))
		{
			$option="<option value=''>--Choose temple--</option>";
			$string=$this->input->post("village");
			if($string!="")
			{
				$data=$this->db->get_where("temple",array("village"=>$string))->result();
				foreach($data as $result)
				{
					$option= $option."<option value='$result->tid|-|$result->tempname'>$result->tempname</option>";
                }
			}
			echo $option;
		}
	
		if($this->input->post("mandal"))
		{
			$option="<option value=''>--Choose village--</option>";
			$string=$this->input->post("mandal");
			if($string!="")
			{
				$data=$this->db->get_where("vtable",array("mid"=>$string))->result();
				foreach($data as $result)
				{
					$option= $option."<option value='$result->vid|-|$result->vname'>$result->vname</option>";
				}
			}
			echo $option;
		}
		if($this->input->post("district"))
		{
			$option2="<option value=''>--choose division data--</option>";
			$string2=$this->input->post("district");
			$data2=$this->db->get_where("divtable",array("did"=>$string2))->result();
			foreach($data2 as $result)
			{
				$option2=$option2."<option value='$result->divid|-|$result->divname'>$result->divname</option>";
			}
			echo $option2;
		}
		if($this->input->post("division"))
		{
			$option3="<option value=''>--choose mandal--</option>";
			$string3=$this->input->post("division");
			$data3=$this->db->get_where("mtable",array("divid"=>$string3))->result();
			foreach($data3 as $result)
			{
				$option3=$option3."<option value='$result->mid|-|$result->mname'>$result->mname</option>";	
			}
			echo $option3;
		}
    }
}
    

    public function dropdowndata2()
	{
        if(isset($_SESSION['admin'])){
		$this->load->database();
		if($this->input->post("state"))
		{
			$pro0=$this->db->get_where("dtable",array("sid"=>$this->input->post("state")))->result();
			$option="<option value=''>---add District---</option>";
			foreach($pro0 as $prodata)
			{
				$option=$option."<option value='$prodata->did|-|$prodata->dname'>$prodata->dname</option>";
			}
			echo $option;
		}

		if($this->input->post("nagaramu"))
		{
			$option="<option value=''>--Choose basti --</option>";
			$string=$this->input->post("nagaramu");
			if($string!="")
			{
				$data=$this->db->get_where("basti",array("nid"=>$string,"brid"=>$this->session->brid))->result();
				foreach($data as $result)
				{
					$option= $option."<option value='$result->id|-|$result->basti'>$result->basti</option>";
				}
			}
			echo $option;
		}
		
        
        if($this->input->post("village"))
		{
			$option="<option value=''>--Choose temple--</option>";
			$string=$this->input->post("village");
			if($string!="")
			{
				$data=$this->db->get_where("activetemp",array("village"=>$string))->result();
				foreach($data as $result)
				{
					$option= $option."<option value='$result->tid|-|$result->tempname'>$result->tempname</option>";
                }
			}
			echo $option;
		}
	
		if($this->input->post("mandal"))
		{
			$option="<option value=''>--Choose village--</option>";
			$string=$this->input->post("mandal");
			if($string!="")
			{
				$data=$this->db->get_where("vtable",array("mid"=>$string))->result();
				foreach($data as $result)
				{
					$option= $option."<option value='$result->vid|-|$result->vname'>$result->vname</option>";
				}
			}
			echo $option;
		}
		if($this->input->post("district"))
		{
			$option2="<option value=''>--choose division data--</option>";
			$string2=$this->input->post("district");
			$data2=$this->db->get_where("divtable",array("did"=>$string2))->result();
			foreach($data2 as $result)
			{
				$option2=$option2."<option value='$result->divid|-|$result->divname'>$result->divname</option>";
			}
			echo $option2;
		}
		if($this->input->post("division"))
		{
			$option3="<option value=''>--choose mandal--</option>";
			$string3=$this->input->post("division");
			$data3=$this->db->get_where("mtable",array("divid"=>$string3))->result();
			foreach($data3 as $result)
			{
				$option3=$option3."<option value='$result->mid|-|$result->mname'>$result->mname</option>";	
			}
			echo $option3;
		}
	}
}
}