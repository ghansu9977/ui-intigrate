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
  deleteStudent: (student: Student) => Promise<void>;
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

export { useStudent, StudentContextType, Student };

export default StudentContext;
