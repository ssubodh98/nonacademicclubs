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
    $registerno = $post_data['registerno'];
    $firstname = $post_data['firstname'];
    $middlename = $post_data['middlename'];
    $lastname = $post_data['lastname'];

    try{
        /*
        $query = $this->db->prepare('INSERT INTO studentdetails (regno, firstname, middlename, lastname, dob, gender, email, phone, bloodgroup, program, year, department, semester, clubid) VALUES ($registerno, $firstname, $middlename, $lastname, '', '', '', '', '', '', '', '', '', '')');*/
        $query = $this->db->prepare('INSERT INTO studentdetails (`regno`, `firstname`, `middlename`, `lastname`) VALUES ($registerno, $firstname, $middlename, $lastname)');
        
        $query->execute();
    }
    catch (Exception $e){
        
        $body->write(json_encode($e));      
    }

    
    return $this->view->render($response, 'register.twig');
})->setName('register');


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
    return $this->view->render($response, 'home.twig', array('items' => $items));
    
})->setName('home');





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

$app->get('/editAttendance/{id}', function($request, $response, $args) {
    
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











