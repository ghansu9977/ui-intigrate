import React, { useState, ReactNode,useEffect } from "react";
import StudentContext from "./StudentContext";
import axios from "axios";

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


// const host = import.meta.env.VITE_LOCAL_BASE_URL;
const StudentState = (props: StudentStateProps) => {
  // Use the Student type for the state
  const [students, setStudents] = useState<Student[]>([]); // Default to an empty array
  
  // get All Students
  const host = import.meta.env.VITE_LOCAL_BASE_URL;
  const [csrfToken, setCsrfToken] = useState<string>("");
  // Fetch CSRF token when the component mounts
  useEffect(() => {
    {const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute("content");
    if (token) {
      setCsrfToken(token);
    }}
  }, []);

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
    try {
      const response = await axios.post(
        `${host}api/create`,
        {
          FirstName: student.FirstName,
          LastName: student.LastName,
          Gender: student.Gender,
          DOB: student.DOB,
        },
        {
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,  // Include CSRF token here
          },
        }
      );
      setStudents((students) => [...students, response.data]);
    } catch (error) {
      console.error("Error:", error);
    }
  };
  const updateStudent = async (student: Student) => {
    try {
      const response = await axios.put(
        `${host}api/update?SID=${student.SID}`,
        {
          FirstName: student.FirstName,
          LastName: student.LastName,
          Gender: student.Gender,
          DOB: student.DOB,
        },
        {
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-Token": csrfToken,  // Include CSRF token here
          },
        }
      );
      // Update students immutably
      setStudents((prevStudents) =>
        prevStudents.map((s) =>
          s.SID === student.SID
            ? { ...s, ...student }
            : s
        )
      );
      console.log(response.data);
    } catch (error) {
      console.error("Error:", error);
    }
  };
  const deleteStudent = async (student: Student): Promise<void> => {
    try {
      const { SID } = student;  // Extract SID from the student object
      const response = await axios.delete(`${host}api/delete?SID=${SID}`, {
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-Token": csrfToken,  // Include CSRF token if required
        },
      });
  
      console.log(response.data);
  
      // Update the students state to remove the deleted student
      setStudents((students) => students.filter(s => s.SID !== SID));
  
    } catch (error) {
      console.error("Error deleting student:", error);
    }
  };
  
  

  return (
    <StudentContext.Provider value={{ students, getStudent, addStudent,updateStudent,deleteStudent }}>
      {props.children}
    </StudentContext.Provider>
  );
};

export default StudentState;
