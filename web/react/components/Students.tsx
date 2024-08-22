import React, { useEffect, useState } from "react";
import StudentsList from "./StudentsList";
import AddStudent from "./AddStudent";

const Students: React.FC = () => {
  return (
    <div className="container">
      <div className="row">
        <div className="col-md-5">
      <button type="button" className="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">
      <i className="fa fa-plus" aria-hidden="true"></i> Add
      </button>
        </div>
        <div className="col-md-6">
      <h1 className="mb-4">Student List</h1>
        </div>
      </div>
      <AddStudent />
      <StudentsList />
    </div>
  );
};

export default Students;
