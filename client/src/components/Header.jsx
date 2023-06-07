import React from "react";

const Navbar = ({ isLoggedIn }) => {
  return (
    <nav>
      <ul>
        <li>
          <a href="/">Home</a>
        </li>
        {!isLoggedIn && (
          <>
            <li>
              <button
                className=""
                onClick={() => {
                  window.location.href = "/signup";
                }}
              >
                Signup
              </button>
            </li>
            <li className="">
              <button
                className=""
                onClick={() => {
                  window.location.href = "/login";
                }}
              >
                Login
              </button>
            </li>
          </>
        )}
      </ul>
    </nav>
  );
};

export default Navbar;
