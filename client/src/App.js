// App.js
import React, { useEffect, useState } from "react";
import "../src/App.css";
import "../node_modules/bootstrap/dist/css/bootstrap.css";
import Navbar from "../src/components/Header";
import Signup from "./components/Signup";
import Login from "./components/Login";
import Dashboard from "./components/Dashboard";
import Section from "./components/Section";

function App() {
  const [user, setUser] = useState(JSON.parse(localStorage.getItem('user')));
  const isLoggedIn = !!user; // Check if user is logged in

  const handleLogin = (userData) => {
    localStorage.setItem('user', JSON.stringify(userData));
    setUser(userData);
  };

  useEffect(() => {
    console.log(isLoggedIn)
  });

  const handleLogout = () => {
    alert('Logout successfully');
    localStorage.removeItem('user');
    setUser(null);
  };

  const RenderContent = () => {
    if (isLoggedIn) {
      return <Dashboard user={user} handleLogout={handleLogout} />;
    } else if (window.location.pathname === "/signup") {
      return <Signup handleLogin={handleLogin} />;
    } else if (window.location.pathname === "/login") {
      return <Login handleLogin={handleLogin} />;
    } else {
      return (
        <>
          <Section />
        </>
      );
    }
  };

  return (
    <>
      <div className="main">
        <Navbar isLoggedIn={isLoggedIn} />
        <RenderContent />
      </div>
    </>
  );
}

export default App;
