<?php

//  Home page {Redirect}
$app->get('/register', function($request, $response, $args) {
  
     return $this->view->render($response, 'register.twig');

})->setName('register');

//$app->get('/create', function($request, $response, $args) {
//  
//     return $this->view->render($response, 'create.twig');
//
//})->setName('home');

$app->get('/login', function($request, $response, $args) {
  
     return $this->view->render($response, 'login.twig');

})->setName('login');
   
$app->post('/register', function($request, $response, $args) {
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $regno = $post_data['regno'];
    $firstname = $post_data['fname'];
    $middlename = $post_data['mname'];
    $lastname = $post_data['lname'];
    $dob = $post_data['dob'];
    $gender = $post_data['gender'];
    $email = $post_data['email'];
    $phone = $post_data['phone'];
    $bloodgroup = $post_data['bgroup'];
    $program = $post_data['program'];
    $year = $post_data['year'];
    $department = $post_data['dept'];
    $semester = $post_data['sem'];
    $clubid = $post_data['cid'];
    $password = $post_data['pass'];
    try{
        /*
        $query = $this->db->prepare('INSERT INTO studentdetails (regno, firstname, middlename, lastname, dob, gender, email, phone, bloodgroup, program, year, department, semester, clubid) VALUES ($registerno, $firstname, $middlename, $lastname, '', '', '', '', '', '', '', '', '', '')');*/
        $query = $this->db->prepare("INSERT INTO `studentdetails` (`regno`, `firstname`, `middlename`, `lastname`, `dob`, `gender`, `email`, `phone`, `bloodgroup`, `program`, `year`, `department`, `semester`, `clubid`) VALUES ('$regno', '$firstname', '$middlename', '$lastname', '$dob', '$gender', '$email', '$phone', '$bloodgroup', '$program', '$year', '$department', '$semester', '$clubid')");
        
        $query->execute();
        
        $query2 = $this->db->prepare("INSERT INTO `login` (`username`, `password`) VALUES ('$regno', '$password')");
        
        $query2->execute();
    }
    catch (Exception $e){
        
        $body->write(json_encode($e));      
    }

    
    return $this->view->render($response, 'register.twig');
})->setName('register');

$app->post('/login', function($request, $response, $args) {
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $email = $post_data['email'];
    $pass = $post_data['password'];
    try{
        $query2 = $this->db->prepare("SELECT * FROM login where `username`='$email' AND `password`='$pass'");
        $query2->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    
    $docs2 = $query2->FetchAll();
    $items2 = array();
    foreach ($docs2 as $doc2){
    $items2[] = $doc2;        
    }

    
    return $this->view->render($response, 'login.twig');
})->setName('login');


//$app->get('/create', function() use($app){
/*  */
$app->get('/create', function ($request, $response, $args) {
    //require_once('config.php');
    //$db->$this->db;

    try{
        $query = $this->db->prepare('SELECT * FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }       
    //echo json_encode($items);
    //echo "aaaaaaa";
    //var_dump($docs[1]["clubname"]);
    
    return $this->view->render($response, 'create.twig', array('items' => $items));
})->setName('create');


$app->post('/create', function($request, $response, $args) {
    
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $clubid = $post_data['clubid'];
    $clubname = $post_data['clubname'];
    $description = $post_data['description'];
    $coordinator = $post_data['coordinator'];
   // var_dump($clubid);
    try{
        
        $query = $this->db->prepare("INSERT INTO `clubdetails` (`clubid`, `clubname`, `description`, `coordinator`) VALUES ('$clubid', '$clubname', '$description', '$coordinator')");
//        $query = $this->db->prepare("INSERT INTO `clubdetails` (`clubid`, `clubname`, `description`, `coordinator`) VALUES (?,?,?,?)");
//        $query->$this->db->bind_param("ssss",'$clubid', '$clubname', '$description', '$coordinator');
        
        $query->execute();
    }
    catch (Exception $e){
        
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
      
     //return $response->withRedirect('create');
     return $this->view->render($response->withRedirect('create'), 'create.twig');
})->setName('create');

//$app->get('/rough', function($request, $response, $args) {
//  
//     return $this->view->render($response, 'rough.php');
//
//})->setName('rough');
//$app->run();

$app->get('/editClub', function($request, $response, $args) {
//    $ar=$args['edit'];
//    var_dump($ar);
    try{
        $query = $this->db->prepare('SELECT * FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }       
    return $this->view->render($response, 'editClub.twig', array('items' => $items));
    
})->setName('editClub');

$app->post('/editClub', function($request, $response, $args) {
    
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $clubid = $post_data['clubid'];
    $clubname = $post_data['clubname'];
    $description = $post_data['description'];
    $coordinator = $post_data['coordinator'];
   // var_dump($clubid);
    try{        
        $query = $this->db->prepare("UPDATE `clubdetails` SET `clubname`='$clubname',`description`='$description',`coordinator`='$coordinator' WHERE `clubid`='$clubid'");
              
//        $query = $this->db->prepare("INSERT INTO `clubdetails` (`clubid`, `clubname`, `description`, `coordinator`) VALUES (?,?,?,?)");
//        $query->$this->db->bind_param("ssss",'$clubid', '$clubname', '$description', '$coordinator');
        
        $query->execute();
    }
    catch (Exception $e){
        
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
      
     //return $response->withRedirect('create');
     return $this->view->render($response->withRedirect('editClub'), 'editClub.twig');
})->setName('editClub');



$app->get('/editClub/delc/{index}', function($request, $response, $args) {
    //$body = $response->getParsedBody();
    $index=$request->getAttribute('index');
    
    
    try{
        $query = $this->db->prepare("DELETE FROM `clubdetails` where `clubid`='$index'");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
/*
    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }      */ 
    return $this->view->render($response->withRedirect('../../editClub'), 'editClub.twig');
    
})->setName('editClub');


$app->get('/viewClub', function($request, $response, $args) {
//    $ar=$args['edit'];
//    var_dump($ar);
    try{
        $query = $this->db->prepare('SELECT clubid,clubname FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    } 
    
    
    return $this->view->render($response, 'viewClub.twig', array('items' => $items));
    
})->setName('viewClub');

$app->get('/viewClub/{index}', function($request, $response, $args) {
    $index=$request->getAttribute('index');
    try{
        $query = $this->db->prepare('SELECT clubid,clubname FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }
    try{
        $query2 = $this->db->prepare("SELECT * FROM studentdetails where `clubid`='$index'");
        $query2->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs2 = $query2->FetchAll();
    $items2 = array();
    foreach ($docs2 as $doc2){
    $items2[] = $doc2;        
    }

    return $this->view->render($response, 'viewClub.twig', array('items' => $items,'items2' => $items2));
    
})->setName('viewClub');


$app->post('/clubs', function($request, $response, $args) {
    
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $clubid = $post_data['clubid'];
    $clubname = $post_data['clubname'];
    $description = $post_data['description'];
    $coordinator = $post_data['coordinator'];
    try{
        
        $query = $this->db->prepare("INSERT INTO `clubdetails` (`clubid`, `clubname`, `description`, `coordinator`) VALUES ('$clubid', '$clubname', '$description', '$coordinator')");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die(); 
    }
    
     return $this->view->render($response->withRedirect('clubs'), 'clubs.twig');
})->setName('clubs');

$app->get('/clubs', function ($request, $response, $args) {
    try{
        $query = $this->db->prepare('SELECT * FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }
    
    try{
        $query2 = $this->db->prepare('SELECT firstname,middlename,lastname FROM coordinatordetails');
        $query2->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs2 = $query2->FetchAll();
    $items3 = array();
    foreach ($docs2 as $doc){
        $items3[] = $doc;        
    }
    return $this->view->render($response, 'clubs.twig', array('items' => $items, 'items3' => $items3));
})->setName('clubs');

$app->post('/clubs/', function($request, $response, $args) {
    
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $clubid = $post_data['clubid'];
    $clubname = $post_data['clubname'];
    $description = $post_data['description'];
    $coordinator = $post_data['coordinator'];
    try{
        
        $query = $this->db->prepare("UPDATE `clubdetails` SET `clubname`='$clubname',`description`='$description',`coordinator`='$coordinator' WHERE `clubid`='$clubid'");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die(); 
    }
     return $this->view->render($response->withRedirect('../clubs'), 'clubs.twig');
})->setName('clubs');

$app->get('/clubs/delc/{index}', function($request, $response, $args) {
    
    $index=$request->getAttribute('index');
    
    
    try{
        $query = $this->db->prepare("DELETE FROM `clubdetails` where `clubid`='$index'");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    return $this->view->render($response->withRedirect('../../clubs'), 'clubs.twig');
    
})->setName('clubs');  



$app->get('/addc', function ($request, $response, $args) {
    //require_once('config.php');
    //$db->$this->db;

    try{
        $query = $this->db->prepare('SELECT * FROM coordinatordetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }       
    //echo json_encode($items);
    //echo "aaaaaaa";
    //var_dump($docs[1]["clubname"]);
    
    return $this->view->render($response, 'addcoordinators.twig', array('items' => $items));
})->setName('addc');


$app->post('/addc', function($request, $response, $args) {
    
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $firstname = $post_data['firstname'];
    $middlename = $post_data['middlename'];
    $lastname = $post_data['lastname'];
    $username = $post_data['username'];
    $clubid = $post_data['clubid'];
    $email = $post_data['email'];
    $phone = $post_data['phone'];
   // var_dump($clubid);
    try{
        $query = $this->db->prepare("INSERT INTO `coordinatordetails` (`firstname`, `middlename`, `lastname`, `username`, 'clubid', `email`, `phone`) VALUES ('$firstname', '$middlename', '$lastname', '$username', '$clubid', '$email', '$phone')");
//        $query = $this->db->prepare("INSERT INTO `clubdetails` (`clubid`, `clubname`, `description`, `coordinator`) VALUES (?,?,?,?)");
//        $query->$this->db->bind_param("ssss",'$clubid', '$clubname', '$description', '$coordinator');
        
        $query->execute();
    }
    catch (Exception $e){
        
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
      
     //return $response->withRedirect('create');
     return $this->view->render($response->withRedirect('addc'), 'addcoordinators.twig');
})->setName('addc');

$app->get('/addc/delc/{index}', function($request, $response, $args) {
    
    $index=$request->getAttribute('index');
    
    
    try{
        $query = $this->db->prepare("DELETE FROM `coordinatordetails` where `username`='$index'");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    return $this->view->render($response->withRedirect('../../addc'), 'addcoordinators.twig');
    
})->setName('addc'); 

$app->post('/addc/', function($request, $response, $args) {
    
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $firstname = $post_data['firstname2'];
    $middlename = $post_data['middlename2'];
    $lastname = $post_data['lastname2'];
    $username = $post_data['username2'];
    $clubid = $post_data['clubid2'];
    $email = $post_data['email2'];
    $phone = $post_data['phone2'];
    try{   
        $query = $this->db->prepare("UPDATE `coordinatordetails` SET `firstname`='$firstname', `middlename`='$middlename', `lastname`='$lastname', `username`='$username', `clubid`='$clubid', `email`='$email', `phone`='$phone' WHERE `username`='$username'");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die(); 
    }
     return $this->view->render($response->withRedirect('../addc'), 'addcoordinators.twig');
})->setName('addc');



$app->get('/markAttendance/{id}', function($request, $response, $args) {
    
    $id=$request->getAttribute('id');
    try{
        $query = $this->db->prepare("SELECT * FROM `studentdetails` where `clubid`=$id");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $stud = array();
    foreach ($docs as $doc){
        $stud[] = $doc;        
    }
    try{
        $query = $this->db->prepare("SELECT * FROM dates");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $ditem = array();
    foreach ($docs as $doc){
        $ditem[] = $doc;        
    }
    return $this->view->render($response, 'Coordinator/markAttendance.twig', array('stud' => $stud , 'ditem' => $ditem));
    
})->setName('markAttendance');

$app->post('/markAttendance/{id}', function($request, $response, $args) {
    $id=$request->getAttribute('id');
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    //$reegno=$post_data['firstname2'];
    $regnos = array();
    foreach($_POST['attend'] as $checkbox){
        $regnos[]=$checkbox;
    }
    var_dump($regno);
    
    
    foreach ($regnos as $regno){
        
    $date=$post_data['date'];
    //$attend[]=$post_data['attend[]'];
    try{
        $query = $this->db->prepare("INSERT INTO `attendance` (`regno`, `date`, `clubid`) VALUES ('$regno', '$date', '$id')");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
    }
    
     return $this->view->render($response->withRedirect('../chome'), 'Coordinator/markAttendance.twig');
})->setName('markAttendance');


$app->get('/chome', function($request, $response, $args) {
//    $ar=$args['edit'];
//    var_dump($ar);
    try{
        $query = $this->db->prepare('SELECT * FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }       
    return $this->view->render($response, 'Coordinator/chome.twig', array('items' => $items));
    
})->setName('chome');


$app->get('/editAttendance/{id}/', function($request, $response, $args) {
    
    $id=$request->getAttribute('id');
    try{
        $query = $this->db->prepare("SELECT * FROM `studentdetails` where `clubid`=$id");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $stud = array();
    foreach ($docs as $doc){
        $stud[] = $doc;        
    }
    try{
        $query = $this->db->prepare("SELECT * FROM dates");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $ditem = array();
    foreach ($docs as $doc){
        $ditem[] = $doc;        
    }
    
    return $this->view->render($response, 'Coordinator/editAttendance.twig', array('stud' => $stud , 'ditem' => $ditem));
    
})->setName('editAttendance');

$app->get('/editAttendance/{id}/datess/{date}/', function($request, $response, $args) {
    
    $id=$request->getAttribute('id');
    $date=$request->getAttribute('date');
    try{
        $query = $this->db->prepare("SELECT * FROM `studentdetails` where `clubid`=$id");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $stud = array();
    foreach ($docs as $doc){
        $stud[] = $doc;        
    }
    try{
        $query = $this->db->prepare("SELECT * FROM dates");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $ditem = array();
    foreach ($docs as $doc){
        $ditem[] = $doc;        
    }
    
    try{
        $query3 = $this->db->prepare("SELECT * FROM attendance where `date`='$date' AND `clubid`=$id");
        $query3->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs3 = $query3->FetchAll();
    $ditem3 = array();
    foreach ($docs3 as $doc3){
        $ditem3[] = $doc3;        
    }
     //var_dump($ditem3);
    return $this->view->render($response, 'Coordinator/editAttendance.twig', array('stud' => $stud, 'ditem' => $ditem, 'ditem3' => $ditem3));
    
})->setName('editAttendance');


$app->get('/editAttendance/{id}/datess/{date}/change/{idd}', function($request, $response, $args) {
    $id=$request->getAttribute('id');
    $date=$request->getAttribute('date');
    $idd=$request->getAttribute('idd');
   
    try{
        $query = $this->db->prepare("DELETE FROM `attendance` WHERE `regno`=$idd AND `date`='$date'");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
    
    
     return $this->view->render($response->withRedirect('../'), 'Coordinator/editAttendance.twig');
})->setName('editAttendance');

$app->get('/editAttendance/{id}/datess/{date}/absent/{idd}', function($request, $response, $args) {
    $id=$request->getAttribute('id');
    $date=$request->getAttribute('date');
    $idd=$request->getAttribute('idd');
   
    try{
        $query = $this->db->prepare("INSERT INTO `attendance` (`regno`, `date`, `clubid`) VALUES ('$idd', '$date', '$id')");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
    
    
     return $this->view->render($response->withRedirect('../'), 'Coordinator/editAttendance.twig');
})->setName('editAttendance');


$app->get('/attendance', function($request, $response, $args) {
//    $ar=$args['edit'];
//    var_dump($ar);
    try{
        $query = $this->db->prepare('SELECT * FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }       
    return $this->view->render($response, 'attendance.twig', array('items' => $items));
    
})->setName('attendance');

$app->get('/vattendance/{id}/', function($request, $response, $args) {
    $id=$request->getAttribute('id');
    $date=$request->getAttribute('date');
    try{
        $query = $this->db->prepare("SELECT * FROM `studentdetails` where `clubid`=$id");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $stud = array();
    foreach ($docs as $doc){
        $stud[] = $doc;        
    }
    try{
        $query = $this->db->prepare("SELECT * FROM dates");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $ditem = array();
    foreach ($docs as $doc){
        $ditem[] = $doc;        
    }
    
    try{
        $query3 = $this->db->prepare("SELECT * FROM attendance where `date`='$date' AND `clubid`=$id");
        $query3->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs3 = $query3->FetchAll();
    $ditem3 = array();
    foreach ($docs3 as $doc3){
        $ditem3[] = $doc3;        
    }
    try{
        $query4 = $this->db->prepare("SELECT * FROM attendance where `clubid`=$id");
        $query4->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs4 = $query4->FetchAll();
    $ditem4 = array();
    foreach ($docs4 as $doc4){
        $ditem4[] = $doc4;        
    }
     //var_dump($ditem3);
    return $this->view->render($response, 'vattendance.twig', array('stud' => $stud, 'ditem' => $ditem, 'ditem3' => $ditem3, 'ditem4' => $ditem4));
    
})->setName('vattendance');

$app->get('/vattendance/{id}/datess/{date}/change/{idd}', function($request, $response, $args) {
    $id=$request->getAttribute('id');
    $date=$request->getAttribute('date');
    $idd=$request->getAttribute('idd');
    
    try{
        $query = $this->db->prepare("SELECT * FROM `attendance` where `clubid`='$id' AND `regno`='$idd' AND `date`='$date'");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $stud = array();
    foreach ($docs as $doc){
        $stud[] = $doc;        
    }
    
        if( count($stud) > 0){
                try{
                    $query = $this->db->prepare("DELETE FROM `attendance` WHERE `regno`=$idd AND `date`='$date'");
                    $query->execute();
                }
                catch (Exception $e){
                    echo $e->getMessage(); 
                    die();
                    //$body->write(json_encode($e));  
            }

        }
        else{
                var_dump("absent");
                try{
                    $query = $this->db->prepare("INSERT INTO `attendance` (`regno`, `date`, `clubid`) VALUES ('$idd', '$date', '$id')");
                    $query->execute();
                }
                catch (Exception $e){
                    echo $e->getMessage(); 
                    die();
                    //$body->write(json_encode($e));  
            }

        

    }
   
    
     
    return $this->view->render($response->withRedirect('../../../'), 'vattendance.twig', array('stud' => $stud/*, 'ditem' => $ditem, 'ditem3' => $ditem3, 'ditem4' => $ditem4*/));
    
})->setName('vattendance');


$app->get('/viewAttendance/{id}', function($request, $response, $args) {
    
    $id=$request->getAttribute('id');
    try{
        $query = $this->db->prepare("SELECT * FROM `studentdetails` where `clubid`=$id");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $stud = array();
    foreach ($docs as $doc){
        $stud[] = $doc;        
    }
    try{
        $query = $this->db->prepare("SELECT * FROM dates");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $ditem = array();
    foreach ($docs as $doc){
        $ditem[] = $doc;        
    }
    return $this->view->render($response, 'Coordinator/viewAttendance.twig', array('stud' => $stud , 'ditem' => $ditem));
    
})->setName('viewAttendance');

$app->get('/viewAttendance/{id}/datess/{date}/', function($request, $response, $args) {
    
    $id=$request->getAttribute('id');
    $date=$request->getAttribute('date');
    try{
        $query = $this->db->prepare("SELECT * FROM `studentdetails` where `clubid`=$id");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $stud = array();
    foreach ($docs as $doc){
        $stud[] = $doc;        
    }
    try{
        $query = $this->db->prepare("SELECT * FROM dates");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $ditem = array();
    foreach ($docs as $doc){
        $ditem[] = $doc;        
    }
    try{
        $query4 = $this->db->prepare("SELECT * FROM attendance where `date`='$date' AND `clubid`=$id");
        $query4->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs4 = $query4->FetchAll();
    $ditem4 = array();
    foreach ($docs4 as $doc4){
        $ditem4[] = $doc4;        
    }
    return $this->view->render($response, 'Coordinator/viewAttendance.twig', array('stud' => $stud , 'ditem' => $ditem,'ditem4' => $ditem4));
    
})->setName('viewAttendance');

$app->get('/home', function($request, $response, $args) {
//    $ar=$args['edit'];
//    var_dump($ar);
    try{
        $query = $this->db->prepare('SELECT * FROM clubdetails');
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }

    $docs = $query->FetchAll();
    //var_dump($docs);
    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }
    try{
        $query = $this->db->prepare("SELECT * FROM dates");
        $query->execute();
    }catch(Exception $e){
        echo $e->getMessage();
        die();
    }
    $docs = $query->FetchAll();
    $ditem = array();
    foreach ($docs as $doc){
        $ditem[] = $doc;        
    }
    return $this->view->render($response, 'home.twig', array('items' => $items, 'ditem' => $ditem));
    
})->setName('home');

$app->post('/home/setd', function($request, $response, $args) {
    $body = $response->getBody();
    $post_data = $request -> getParsedBody();
    $date = $post_data['setd'];
    $valid = "1";
    try{
        $query = $this->db->prepare("INSERT INTO `dates` (`date`, `valid`) VALUES ('$date', '$valid')");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
    return $this->view->render($response->withRedirect('../home'), 'home.twig');
    
})->setName('home');

$app->get('/home/freez/{date}/', function($request, $response, $args) {
    $date=$request->getAttribute('date');
    $valid = "0";
    try{
        $query = $this->db->prepare("UPDATE `dates` SET `valid`='$valid' WHERE `date`='$date'");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
    return $this->view->render($response->withRedirect('../../../home'), 'home.twig');
    
})->setName('home');

$app->get('/home/open/{date}/', function($request, $response, $args) {
    $date=$request->getAttribute('date');
    $valid = "1";
    try{
        $query = $this->db->prepare("UPDATE `dates` SET `valid`='$valid' WHERE `date`='$date'");
        $query->execute();
    }
    catch (Exception $e){
        echo $e->getMessage(); 
        die();
        //$body->write(json_encode($e));  
    }
    return $this->view->render($response->withRedirect('../../../home'), 'home.twig');
    
})->setName('home');





