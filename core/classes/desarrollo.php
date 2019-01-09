<?php 
    
    class Desarrollo
    {
        protected $pdo;

        function __construct($pdo)
        {
            $this->pdo = $pdo;
        }

        //to check if he put some valid characters
        public function checkInput($var){
            $var = htmlspecialchars($var);
            $var = trim($var);
            $var = stripcslashes($var);
            return $var;
        }

        // this part is for the user registration
        public function registrarDesarrollo($idcategoria, $idsubcategoria, $direccion, $precio_por_metro, $foto_portada, $foto_section, $descripcion, $latitud, $longitud, $detalle_de_entrega)
        {
            $stmt = $this->pdo->prepare("INSERT INTO `desarrollos` ( `idcategoria`, `idsubcategoria`, `direccion`, `precio_por_metro`, `foto_portada`, `foto_section`, `descripcion`, `latitud`, `longitud`, `detalle_de_entrega` ) VALUES(:idcategoria, :idsubcategoria, :direccion, :precio_por_metro, :foto_portada, :foto_section, :descripcion, :latitud, :longitud, :detalle_de_entrega )");  
            $stmt->bindParam(":idcategoria", $idcategoria, PDO::PARAM_INT);
            $stmt->bindParam(":idsubcategoria", $idsubcategoria, PDO::PARAM_INT);
            $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->bindParam(":precio_por_metro", $precio_por_metro, PDO::PARAM_STR);
            $stmt->bindParam(":foto_portada", $foto_portada, PDO::PARAM_STR);
            $stmt->bindParam(":foto_section", $foto_section, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":latitud", $latitud, PDO::PARAM_STR);
            $stmt->bindParam(":longitud", $longitud, PDO::PARAM_STR);
            $stmt->bindParam(":detalle_de_entrega", $detalle_de_entrega, PDO::PARAM_STR);
            $stmt->execute();

            $desarrollo_id = $this->pdo->lastInsertId();
            $_SESSION['desarrollo_id'] = $desarrollo_id;
            /*return $_SESSION['id'];*/
        }
        
        // update desarrollo Information
        public function updateDesarrollo($id, $idcategoria, $idsubcategoria, $direccion, $precio_por_metro, $foto_portada, $foto_section, $descripcion, $latitud, $longitud, $detalle_de_entrega)
        {
            $stmt = $this->pdo->prepare(
                "UPDATE desarrollos SET idcategoria = :idcategoria, idsubcategoria = :idsubcategoria, direccion = :direccion, precio_por_metro = :precio_por_metro, foto_portada = :foto_portada, foto_section = :foto_section, descripcion = :descripcion, latitud = :latitud, longitud = :longitud, detalle_de_entrega = :detalle_de_entrega WHERE id = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":idcategoria", $idcategoria, PDO::PARAM_INT);
            $stmt->bindParam(":idsubcategoria", $idsubcategoria, PDO::PARAM_INT);
            $stmt->bindParam(":direccion", $direccion, PDO::PARAM_STR);
            $stmt->bindParam(":precio_por_metro", $precio_por_metro, PDO::PARAM_STR);
            $stmt->bindParam(":foto_portada", $foto_portada, PDO::PARAM_STR);
            $stmt->bindParam(":foto_section", $foto_section, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":latitud", $latitud, PDO::PARAM_STR);
            $stmt->bindParam(":longitud", $longitud, PDO::PARAM_STR);
            $stmt->bindParam(":detalle_de_entrega", $detalle_de_entrega, PDO::PARAM_STR);
            

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // delete desarrollo
        public function deleteDesarrollo($id){
            $stmt = $this->pdo->prepare("DELETE FROM `desarrollos` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // delete Especificacion
        public function deleteEspecificacionD($id_desarrollo){
            $stmt = $this->pdo->prepare("DELETE FROM `especificaciones` WHERE `id_desarrollo` = :id_desarrollo ");
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }
        // delete Especificacion
        public function deleteCaracteristicaD($id_desarrollo){
            $stmt = $this->pdo->prepare("DELETE FROM `caracteristicas` WHERE `id_desarrollo` = :id_desarrollo ");
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }
        // delete Especificacion
        public function deleteFotoD($id_desarrollo){
            $stmt = $this->pdo->prepare("DELETE FROM `fotos` WHERE `id_desarrollo` = :id_desarrollo ");
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }
        // delete Especificacion
        public function deletePlantaD($id_desarrollo){
            $stmt = $this->pdo->prepare("DELETE FROM `plantas` WHERE `id_desarrollo` = :id_desarrollo ");
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // this part is for the Especificacion
        public function addNewEspecificacion($id_desarrollo, $Estar_y_Monoambiente, $banios, $dormitorios, $cocinas)
        {
            /*var_dump($id_desarrollo, $Estar_y_Monoambiente, $banios, $dormitorios, $cocinas);*/
            $stmt = $this->pdo->prepare("INSERT INTO `especificaciones` ( `id_desarrollo`, `Estar_y_Monoambiente`, `banios`, `dormitorios`, `cocinas` ) VALUES(:id_desarrollo, :Estar_y_Monoambiente, :banios, :dormitorios, :cocinas)");  
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_INT);
            $stmt->bindParam(":Estar_y_Monoambiente", $Estar_y_Monoambiente, PDO::PARAM_STR);
            $stmt->bindParam(":banios", $banios, PDO::PARAM_STR);
            $stmt->bindParam(":dormitorios", $dormitorios, PDO::PARAM_STR);
            $stmt->bindParam(":cocinas", $cocinas, PDO::PARAM_STR);
            
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // update Especificacion 
        public function updateEspecificacion($id_desarrollo, $Estar_y_Monoambiente, $banios, $dormitorios,  $cocinas)
        {
            $stmt = $this->pdo->prepare(
                "UPDATE especificaciones SET Estar_y_Monoambiente = :Estar_y_Monoambiente, banios = :banios, dormitorios = :dormitorios, cocinas = :cocinas WHERE id_desarrollo = :id_desarrollo ");
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_INT);
            $stmt->bindParam(":Estar_y_Monoambiente", $Estar_y_Monoambiente, PDO::PARAM_STR);
             $stmt->bindParam(":banios", $banios, PDO::PARAM_STR);
            $stmt->bindParam(":dormitorios", $dormitorios, PDO::PARAM_STR);
            $stmt->bindParam(":cocinas", $cocinas, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // delete Especificacion
        public function deleteEspecificacion($id){
            $stmt = $this->pdo->prepare("DELETE FROM `especificaciones` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }


        // this part is for the user registration
        public function addRelevante($id_desarrollo, $cantidad, $descripcion){
            $stmt = $this->pdo->prepare("INSERT INTO `relevantes` ( `id_desarrollo`, `cantidad`, `descripcion`) VALUES(:id_desarrollo, :cantidad, :descripcion )");  
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // update caracteristica 
        public function updateRelevante($id, $cantidad, $descripcion)
        {
            $stmt = $this->pdo->prepare(
                "UPDATE relevantes SET cantidad = :cantidad, descripcion = :descripcion WHERE id = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $descripcion, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // delete user account
        public function deleteRelevante($id){
            $stmt = $this->pdo->prepare("DELETE FROM `relevantes` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // this part is for the user registration
        public function addCaracteristica($id_desarrollo, $planta, $ambiente_1, $ambiente_2,  $ambiente_3,  $ambiente_4){
            $stmt = $this->pdo->prepare("INSERT INTO `caracteristicas` ( `id_desarrollo`, `planta`, `ambiente_1`, `ambiente_2`, `ambiente_3`, `ambiente_4` ) VALUES(:id_desarrollo, :planta, :ambiente_1, :ambiente_2, :ambiente_3, :ambiente_4 )");  
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_INT);
            $stmt->bindParam(":planta", $planta, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_1", $ambiente_1, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_2", $ambiente_2, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_3", $ambiente_3, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_4", $ambiente_4, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // update caracteristica 
        public function updateCaracteristica($id, $planta, $ambiente_1, $ambiente_2,  $ambiente_3,  $ambiente_4)
        {
            $stmt = $this->pdo->prepare(
                "UPDATE caracteristicas SET planta = :planta, ambiente_1 = :ambiente_1, ambiente_2 = :ambiente_2, ambiente_3 = :ambiente_3, ambiente_4 = :ambiente_4 WHERE id = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":planta", $planta, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_1", $ambiente_1, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_2", $ambiente_2, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_3", $ambiente_3, PDO::PARAM_STR);
            $stmt->bindParam(":ambiente_4", $ambiente_4, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // delete user account
        public function deleteCaracteristica($id){
            $stmt = $this->pdo->prepare("DELETE FROM `caracteristicas` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // this part is for the user registration
        public function addNewFoto($id_desarrollo, $nombre, $foto){
            $stmt = $this->pdo->prepare("INSERT INTO `fotos` ( `id_desarrollo`, `nombre`, `foto` ) VALUES(:id_desarrollo, :nombre, :foto )"); 
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // Update Foto
        public function updateFoto($id, $nombre, $foto){
            $stmt = $this->pdo->prepare(" UPDATE fotos SET nombre = :nombre, foto = :foto WHERE id = :id "); 
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":foto", $foto, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // delete user account
        public function deleteFoto($id){
            $stmt = $this->pdo->prepare("DELETE FROM `fotos` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

         // this part is for the user registration
        public function addNewPlanta($id_desarrollo, $nombre, $imagen, $pdf){
            $stmt = $this->pdo->prepare("INSERT INTO `plantas` ( `id_desarrollo`, `nombre`, `imagen`, `pdf` ) VALUES(:id_desarrollo, :nombre, :imagen, :pdf )"); 
            $stmt->bindParam(":id_desarrollo", $id_desarrollo, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $imagen, PDO::PARAM_STR);
            $stmt->bindParam(":pdf", $pdf, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // Update Foto
        public function updatePlanta($id, $nombre, $imagen, $pdf){
            $stmt = $this->pdo->prepare(" UPDATE plantas SET nombre = :nombre, imagen = :imagen, pdf = :pdf WHERE id = :id "); 
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $nombre, PDO::PARAM_STR);
            $stmt->bindParam(":imagen", $imagen, PDO::PARAM_STR);
            $stmt->bindParam(":pdf", $pdf, PDO::PARAM_STR);

            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // delete user account
        public function deletePlanta($id){
            $stmt = $this->pdo->prepare("DELETE FROM `plantas` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_STR);
           
            if ( $stmt->execute()) {
                return "ok";
            }else{
                return "nada";
            }
        }

        // this part is to use all the data from the user
        public function desarrolloData($id){
            $stmt = $this->pdo->prepare("SELECT * FROM `desarrollos` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }


        // Select All Categories
        public function selectCategorias(){
            $stmt = $this->pdo->prepare("SELECT * FROM `categorias` ");
            $stmt->execute();
            $categorias = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $categorias;
        }

        // Select All Categories
        public function selectSubcategorias(){
            $stmt = $this->pdo->prepare("SELECT * FROM `subcategorias` ");
            $stmt->execute();
            $subcategorias = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $subcategorias;
        }

        // Select All Desarrollo
        public function selectDesarrollos(){
            $stmt = $this->pdo->prepare("SELECT * FROM `desarrollos` ");
            $stmt->execute();
            $desarrollos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $desarrollos;
        }

        //Show Desarrollo by id
        public function selectDesarrolloById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM `desarrollos` WHERE `id` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $desarrollo = $stmt->fetch(PDO::FETCH_OBJ);
            return $desarrollo;
        }
        //Show Especificacion by desarrollo Id
        public function especificacionById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM `especificaciones` WHERE `id_desarrollo` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $especificacion = $stmt->fetch(PDO::FETCH_OBJ);
            return $especificacion;
        }
        //Show Especificacion by desarrollo Id
        public function relevanteById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM `relevantes` WHERE `id_desarrollo` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $rel = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $rel;
        }
        //Show Especificacion by desarrollo Id
        public function caracteristicaById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM `caracteristicas` WHERE `id_desarrollo` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $caracteristica = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $caracteristica;
        }
        //Show Especificacion by desarrollo Id
        public function fotoById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM `fotos` WHERE `id_desarrollo` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $foto = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $foto;
        }
        //Show Especificacion by desarrollo Id
        public function plantaById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM `plantas` WHERE `id_desarrollo` = :id ");
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $planta = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $planta;
        }

        // to check if he already login
        public function loggedIn(){
            return (isset($_SESSION['user_id'])) ? true : false;
        }

       /* public function upload_image(){
            if(isset($_FILES["file"]))
            {
                $extension = explode('.', $_FILES['file']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = 'upload/' . $new_name;
                move_uploaded_file($_FILES['file']['tmp_name'], $destination);
                return $new_name;
            }
        }*/

        // this is to upload images
        public function uploadImage($file){
            $filename = basename($file['name']);
            $fileTmp  = $file['tmp_name'];
            $fileSize = $file['size'];
            $error    = $file['error'];

            $ext         = explode('.', $filename);
            $ext         = strtolower(end($ext));
            $allowed_ext = array('jpg', 'png', 'jpeg');

            if (in_array($ext, $allowed_ext) === true) {
                if ($error === 0) {
                    if ($fileSize <= 209272152) {
                       $fileRoot = BASE_URL.'assets/img/users/' . $filename;
                       move_uploaded_file($fileTmp, $fileRoot);
                       return $fileRoot;
                    }else{
                      $GLOBALS['imageError'] = "esta foto es demasiado grando ";
                    }
                }
            }else{
                $GLOBALS['imageError'] = "esta extension no esta permitida ";
            }
        }

        // delete user account
        public function deleteAccount($user_id){
            $stmt = $this->pdo->prepare("DELETE FROM `users` WHERE `user_id` = :user_id ");
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION = array();
            session_destroy();
        }
    }
?>