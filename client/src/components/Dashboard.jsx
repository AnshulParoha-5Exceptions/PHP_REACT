// Dashboard.jsx
import React from "react";

const Dashboard = ({ user, handleLogout }) => {
  return (
    <>
    <div className="row">
      <div className="col-md-4"></div>
      <div className="col-md-4">
      <h3>Welcome, {user.name}!</h3>
      <p>Email: {user.email}</p>
      <p>Contact: {user.contact}</p>
      <p>Address: {user.address}</p>
      <button className="btn btn-danger" onClick={handleLogout}>
        Logout
      </button>
      </div>
      <div className="col-md-4"></div>
    </div>
    </>
  );
};

export default Dashboard;
