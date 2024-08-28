import React, { useState } from "react";
import StudentsList from "@/components/StudentsList";
import AddStudent from "@/components/AddStudent";
const Students: React.FC = () => {
  return (
    <div className="container">
      <div className="row mb-4">
        <div className="col-md-5">
          {/* AddStudent Button */}
          <AddStudent />
        </div>

        <div className="col-md-6">
          <h1 className="mb-4">Student List</h1>
        </div>
      </div>
      {/* StudentList */}
      <StudentsList />
    </div>
  );
};

export default Students;
