

/*
require __DIR__ . '\..\..\vendor\autoload.php';

// Create new Slim app with custom config.

$config = require __DIR__ . '\..\..\app\config.php';
$app = new Slim\App( $config );

// Include middleware and routes.

require __DIR__ . '/../../app/middleware.php';
require __DIR__ . '\..\..\app/routes.php';

$app->get('/rough', function() {
        
        $query = $this->db->prepare("SELECT * FROM `clubdetails`");
        
        $result = $query->execute();
    
        //$result_array = $result->fetchAll(PDO::FETCH_ASSOC);
    $result_array = query->clubname;
        echo json_encode($result_array);
   
    /*
    while($row= $result->fetch_assoc()){s
		$data[]=$row;

	}
    ;
    $docs = $result->fetchAll(PDO::FETCH_ASSOC);

    $items = array();
    foreach ($docs as $doc){
        $items[] = $doc;        
    }  
    
    if(isset($result)){
        echo json_encode(docs);
    
    }
   
    echo "asdasd";

});
*/