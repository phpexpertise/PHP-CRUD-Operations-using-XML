<?php 
class Xml
{

    function readXML($fileName, $title, $id=NULL) {
        $xml_file_name = XML_FILE_PATH.'/' . $fileName;

        $newArr = array(
            'title' => $title,
            'record' => array()
        );

        if (file_exists($xml_file_name)) {
            // Read entire file into string 
            $xmlfile = file_get_contents($xml_file_name); 
            
            // Convert xml string into an object 
            $new = simplexml_load_string($xmlfile); 
            
            // Convert into json 
            $con = json_encode($new); 
            
            // Convert into associative array 
            $results = json_decode($con, true); 

            $newArr['title'] = $results['title'];

            $recordArr = $results['rows']['record'];

            if (isset($recordArr[0]) && $results) {
                foreach ($results['rows']['record'] as $data) {
                    $newArr['record'][$data['id']] = $data;
                }
            } else {
                $newArr['record'][$results['rows']['record']['id']] = $results['rows']['record'];
            }
        }

        if ($id) {
            return $newArr['record'][$id];
        } else {
            return $newArr;
        }
        
    }
    
    function generateXML($data) {
        $title = $data['title'];
        $rowCount = count($data['record']);
        
        //create the xml document
        $xmlDoc = new DOMDocument();
        
        $root = $xmlDoc->appendChild($xmlDoc->createElement($title));
        $root->appendChild($xmlDoc->createElement("title",$title));
        $root->appendChild($xmlDoc->createElement("totalRows",$rowCount));
        $tabResults = $root->appendChild($xmlDoc->createElement('rows'));
        
        foreach($data['record'] as $result){
            if(!empty($result)){
                $tabResult = $tabResults->appendChild($xmlDoc->createElement('record'));
                foreach($result as $key => $val){
                    $tabResult->appendChild($xmlDoc->createElement($key, $val));
                }
            }
        }
        
        header("Content-Type: text/plain");
        
        //make the output pretty
        $xmlDoc->formatOutput = true;
        
        //save xml file
        $file_name = str_replace(' ', '_', $title).'.xml';
        $xmlDoc->save(XML_FILE_PATH.'/'.$file_name);
        
        //return xml file name
        return $file_name;
    }
}
?>
