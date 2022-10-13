<?php

    class StudentModel
    {

        // Connection
        private $conn;

        // Table
        private $db_table = "students";

        // Columns
        public $student_id;
        public $student_surname;
        public $student_given_name;
        public $student_section;
        public $student_created;

        // Db connection
        public function __construct($db)
        {

            $this->conn = $db;

        }

        // Create
        public function onCreateStudent()
        {

            $sql = "INSERT INTO " . $this->db_table . " SET 
                        student_surname = :student_surname, 
                        student_given_name = :student_given_name, 
                        student_section = :student_section,
                        student_created = :student_created";
        
            $stmt = $this->conn->prepare($sql);
        
            // sanitize
            $this->student_surname=htmlspecialchars(strip_tags($this->student_surname));
            $this->student_given_name=htmlspecialchars(strip_tags($this->student_given_name));
            $this->student_section=htmlspecialchars(strip_tags($this->student_section));
            $this->student_created=htmlspecialchars(strip_tags($this->student_created));
        
            // bind data
            $stmt->bindParam(":student_surname", $this->student_surname);
            $stmt->bindParam(":student_given_name", $this->student_given_name);
            $stmt->bindParam(":student_section", $this->student_section);
            $stmt->bindParam(":student_created", $this->student_created);
        
            if($stmt->execute())
            {

               return true;

            }
            return false;

        }

        // Read
        public function getStudents()
        {

            $sql = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;

        }

        // Single Read
        public function getSingleStudent()
        {

            $sql = "SELECT * FROM " . $this->db_table . " WHERE student_id = ? LIMIT 0,1";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(1, $this->student_id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->student_surname = $dataRow['student_surname'];
            $this->student_given_name = $dataRow['student_given_name'];
            $this->student_section = $dataRow['student_section'];
            $this->student_created = $dataRow['student_created'];

        }

        // Update
        public function onUpdateStudent()
        {

            $sql = "UPDATE " . $this->db_table . " 
                    SET
                        student_surname = :student_surname, 
                        student_given_name = :student_given_name, 
                        student_section = :student_section,
                        student_created = :student_created
                    WHERE 
                        student_id = :student_id";
        
            $stmt = $this->conn->prepare($sql);
        
            $this->student_surname=htmlspecialchars(strip_tags($this->student_surname));
            $this->student_given_name=htmlspecialchars(strip_tags($this->student_given_name));
            $this->student_section=htmlspecialchars(strip_tags($this->student_section));
            $this->student_created=htmlspecialchars(strip_tags($this->student_created));
            $this->student_id=htmlspecialchars(strip_tags($this->student_id));
        
            // bind data
            $stmt->bindParam(":student_surname", $this->student_surname);
            $stmt->bindParam(":student_given_name", $this->student_given_name);
            $stmt->bindParam(":student_section", $this->student_section);
            $stmt->bindParam(":student_created", $this->student_created);
            $stmt->bindParam(":student_id", $this->student_id);
        
            if($stmt->execute())
            {

               return true;

            }
            return false;

        }

        // Delete
        public function onDeleteStudent()
        {
            
            $sql = "DELETE FROM " . $this->db_table . " WHERE student_id = ?";

            $stmt = $this->conn->prepare($sql);
        
            $this->student_id=htmlspecialchars(strip_tags($this->student_id));
        
            $stmt->bindParam(1, $this->student_id);
        
            if($stmt->execute())
            {

                return true;

            }
            return false;

        }

    }

?>