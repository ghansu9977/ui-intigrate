import React, { useEffect, useState } from "react";
import StudentsList from "./StudentsList";
import AddStudent from "./AddStudent";

interface Student {
  SID: number;
  FirstName: string;
  LastName: string;
  DOB: string;
  Gender: string;
}

const Students: React.FC = () => {
  const [estudent,setEstudent] = useState<Partial<Student>>({})
  const handleClick = ()=>{
    
  }
  const onChange = (e)=>{
    setEstudent({...estudent,[e.target.name]:e.target.value});
  }
  return (
    <div className="container">
      <div className="row">
        <div className="col-md-5">
      {/* AddStudent Button */}
      <button type="button" className="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddModal">
      <i className="fa fa-plus" aria-hidden="true"></i> Add
      </button>
        </div>
        <div className="col-md-6">
      <h1 className="mb-4">Student List</h1>
        </div>
      </div>

      {/* AddStudent */}
      <AddStudent />

      {/* ViewStudent */}
      <div className="modal fade" id="ViewModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div className="modal-dialog modal-lg">
        <div className="modal-content">
          <div className="modal-header">
            <h5 className="modal-title" id="exampleModalLabel">Student Details</h5>
            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div className="modal-body">
            <form>
              <div className="form-group">
                <div className="row">
                  <div className="col-md-6">
                    <label htmlFor="eFirstName">First Name</label>
                    <input type="text" className="form-control" id="eFirstName" name="eFirstName" disabled value={estudent.FirstName} aria-describedby="fnameHelp" placeholder="Enter First Name" />
                  </div>
                  <div className="col-md-6">
                    <label htmlFor="eLastName">Last Name</label>
                    <input type="text" className="form-control" id="eLastName" name="eLastName" disabled value={estudent.LastName} aria-describedby="lnameHelp" placeholder="Enter Last Name" />
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label htmlFor="eDOB">DOB</label>
                    <input type="date" className="form-control" id="eDOB" name="eDOB" disabled value={estudent.DOB} />
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label htmlFor="eGender">Gender</label>
                    <select className="form-control" id="eGender" name="eGender" disabled value={estudent.Gender}>
                      <option defaultValue={""}>Choose...</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
            </div>
            <div className="modal-footer">
              <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" className="btn btn-primary" onClick={handleClick}>Save changes</button>
            </div>
          </div>
        </div>
      </div>


      {/* EditStudent */}
      <div className="modal fade" id="EditModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div className="modal-dialog modal-lg">
        <div className="modal-content">
          <div className="modal-header">
            <h5 className="modal-title" id="exampleModalLabel">Edit Student</h5>
            <button type="button" className="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div className="modal-body">
            <form>
              <div className="form-group">
                <div className="row">
                  <div className="col-md-6">
                    <label htmlFor="eFirstName">First Name</label>
                    <input type="text" className="form-control" id="eFirstName" name="eFirstName" value={estudent.FirstName} onChange={onChange} aria-describedby="fnameHelp" placeholder="Enter First Name" />
                  </div>
                  <div className="col-md-6">
                    <label htmlFor="eLastName">Last Name</label>
                    <input type="text" className="form-control" id="eLastName" name="eLastName" value={estudent.LastName} onChange={onChange} aria-describedby="lnameHelp" placeholder="Enter Last Name" />
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label htmlFor="eDOB">DOB</label>
                    <input type="date" className="form-control" id="eDOB" name="eDOB" value={estudent.DOB} onChange={onChange} />
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label htmlFor="eGender">Gender</label>
                    <select className="form-control" id="eGender" name="eGender" value={estudent.Gender} onChange={onChange}>
                      <option defaultValue={""}>Choose...</option>
                      <option value="M">Male</option>
                      <option value="F">Female</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
            </div>
            <div className="modal-footer">
              <button type="button" className="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" className="btn btn-primary" onClick={handleClick}>Save changes</button>
            </div>
          </div>
        </div>
      </div>

      {/* StudentList */}
      <StudentsList setEstudent={setEstudent} />
    </div>
  );
};

export default Students;
