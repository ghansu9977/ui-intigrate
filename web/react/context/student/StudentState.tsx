import React, { useState, ReactNode } from "react";
import StudentContext from "./StudentContext";
import axios from "axios";

// Define the type for the student data
interface Student {
  SID: number;
  FirstName: string;
  LastName: string;
  DOB: string;
  Gender: string;
}

// Define the type for the context provider's props
interface StudentStateProps {
  children: ReactNode;
}

const StudentState = (props: StudentStateProps) => {
  const host = "http://localhost:8080/";

  // Use the Student type for the state
  const [students, setStudents] = useState<Student[]>([]); // Default to an empty array

  // get All Students
  const getStudent = async () => {
    try {
      const response = await axios.get<Student[]>(`${host}api/fetchall`);
      setStudents(response.data);
    } catch (error) {
      console.error("Failed to fetch students", error);
    }
  };

  // addStudent function to add a new student
  const addStudent = async (student: Student) => {
    const response = await axios.post(`${host}api/create`, {
      FirstName: student.FirstName,
      LastName: student.LastName,
      Gender: student.Gender,
      DOB: student.DOB
  }, {
      headers: {
          'Content-Type': 'application/json',
      }
  })
  .then(response => console.log(response.data))
  .catch(error => console.error('Error:', error));
  };

  return (
    <StudentContext.Provider value={{ students, getStudent, addStudent }}>
      {props.children}
    </StudentContext.Provider>
  );
};

export default StudentState;
