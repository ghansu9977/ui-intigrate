import { createContext } from "react";

// Define the type for the student data
interface Student {
  SID: number;
  FirstName: string;
  LastName: string;
  DOB: string;
  Gender: string;
}

// Define the type for your context's value
interface StudentContextType {
  students: Student[]; // Array of Student objects
  getStudent: () => Promise<void>; // Function to get students, returning a promise
  addStudent: (student: Student) => void; // Function to add a student
}

// Create the context with a default value
const StudentContext = createContext<StudentContextType | null>(null);

export default StudentContext;
