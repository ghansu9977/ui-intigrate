import React, { useEffect, useState } from "react";
import StudentsList from "./StudentsList";

const Students: React.FC = () => {
  return (
    <div className="container">
      <h1>Student List</h1>
      <StudentsList />
    </div>
  );
};

export default Students;
