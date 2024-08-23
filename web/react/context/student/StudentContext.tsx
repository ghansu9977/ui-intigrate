import React, { createContext, useContext, ReactNode, useState } from "react";
import axios from "axios";

// Define the type for the student data
interface Student {
  SID: number;
  FirstName: string;
  LastName: string;
  DOB: string;
  Gender: string;
}

// Define the type for the context's value
interface StudentContextType {
  students: Student[];
  getStudent: () => Promise<void>;
  addStudent: (student: Student) => Promise<void>;
  updateStudent: (student: Student) => Promise<void>;
}

// Create the context with a default value
const StudentContext = createContext<StudentContextType | undefined>(undefined);

// Custom hook to use the StudentContext
const useStudent = () => {
  const context = useContext(StudentContext);
  if (!context) {
    throw new Error("useStudent must be used within a StudentProvider");
  }
  return context;
};

// Provider component
const StudentProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const [students, setStudents] = useState<Student[]>([]);

  const host = "http://localhost:8080/";

  const getStudent = async () => {
    try {
      const response = await axios.get<Student[]>(`${host}api/fetchall`);
      setStudents(response.data);
    } catch (error) {
      console.error("Failed to fetch students", error);
    }
  };

  const addStudent = async (student: Student) => {
    try {
      await axios.post(`${host}api/create`, student, {
        headers: {
          "Content-Type": "application/json",
        },
      });
      await getStudent(); // Refresh student list
    } catch (error) {
      console.error("Failed to add student", error);    
    }
  };

  return (
    <StudentContext.Provider value={{ students, getStudent, addStudent }}>
      {children}
    </StudentContext.Provider>
  );
};

export { StudentProvider, useStudent, StudentContextType, Student };
