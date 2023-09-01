<?php
    class Peserta{
        // Connection
        private $conn;
        // Table
        private $db_table = "peserta";
        // Columns
        public $id;
        public $nama;
        public $email;
        public $no_hp;
        public $nik;
        public $kpj;
        public $tempat_lahir;
        public $tanggal_lahir;
        public $alamat;
        public $created;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }
        // GET ALL
        public function getPeserta(){
            $sqlQuery = "SELECT id, nama, email, no_hp, nik, kpj, tempat_lahir, alamat, tanggal_lahir, created FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        // CREATE
        public function createPeserta(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        email = :email, 
                        no_hp = :no_hp, 
                        nik =:nik,
                        kpj = :kpj, 
                        tanggal_lahir = :tanggal_lahir, 
                        tempat_lahir = :tempat_lahir, 
                        alamat = :alamat, 
                        created = :created";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->no_hp=htmlspecialchars(strip_tags($this->no_hp));
            $this->nik=htmlspecialchars(strip_tags($this->nik));
            $this->kpj=htmlspecialchars(strip_tags($this->kpj));
            $this->tanggal_lahir=htmlspecialchars(strip_tags($this->tanggal_lahir));
            $this->tempat_lahir=htmlspecialchars(strip_tags($this->tempat_lahir));
            $this->alamat=htmlspecialchars(strip_tags($this->alamat));
            $this->created=htmlspecialchars(strip_tags($this->created));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":no_hp", $this->no_hp);
            $stmt->bindParam(":nik", $this->nik);
            $stmt->bindParam(":kpj", $this->kpj);
            $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
            $stmt->bindParam(":tempat_lahir", $this->tempat_lahir);
            $stmt->bindParam(":alamat", $this->alamat);
            $stmt->bindParam(":created", $this->created);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // READ single
        public function getSinglePeserta(){
            $sqlQuery = "SELECT
                        id, 
                        nama, 
                        email, 
                        no_hp, 
                        nik, 
                        kpj, 
                        tempat_lahir, 
                        tanggal_lahir, 
                        alamat, 
                        created
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->nama = $dataRow['nama'];
            $this->email = $dataRow['email'];
            $this->no_hp = $dataRow['no_hp'];
            $this->nik = $dataRow['nik'];
            $this->nik = $dataRow['kpj'];
            $this->nik = $dataRow['tempat_lahir'];
            $this->nik = $dataRow['tanggal_lahir'];
            $this->nik = $dataRow['alamat'];
            $this->created = $dataRow['created'];
        }        
        // UPDATE
        public function updatePeserta(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        nama = :nama, 
                        email = :email, 
                        no_hp = :no_hp, 
                        nik = :nik, 
                        kpj = :kpj, 
                        tempat_lahir = :tempat_lahir, 
                        tanggal_lahir = :tanggal_lahir, 
                        alamat = :alamat, 
                        created = :created
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->nama=htmlspecialchars(strip_tags($this->nama));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->no_hp=htmlspecialchars(strip_tags($this->no_hp));
            $this->nik=htmlspecialchars(strip_tags($this->nik));


            $this->kpj=htmlspecialchars(strip_tags($this->kpj));
            $this->tempat_lahir=htmlspecialchars(strip_tags($this->tempat_lahir));
            $this->alamat=htmlspecialchars(strip_tags($this->alamat));
            $this->tanggal_lahir=htmlspecialchars(strip_tags($this->tanggal_lahir));

            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":nama", $this->nama);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":no_hp", $this->no_hp);
            $stmt->bindParam(":nik", $this->nik);

            $stmt->bindParam(":kpj", $this->kpj);
            $stmt->bindParam(":tempat_lahir", $this->tempat_lahir);
            $stmt->bindParam(":tanggal_lahir", $this->tanggal_lahir);
            $stmt->bindParam(":alamat", $this->alamat);

            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deletePeserta(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
            echo json_encode($stmt->execute());
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>