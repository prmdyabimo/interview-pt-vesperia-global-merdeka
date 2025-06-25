import React from "react";
import "./styles/Navigation.css";

const Navigation = ({ currentPage, onPageChange }) => {
  const pages = [
    {
      id: "kejadian",
      label: "Detail Kejadian Risiko",
      component: "DetailKejadianResikoPage",
    },
    {
      id: "kerugian",
      label: "Detail Kerugian",
      component: "DetailKerugianPage",
    },
    {
      id: "list_data",
      label: "List Data",
      component: "ListDataPage",
    }
  ];

  return (
    <nav className="navigation">
      <div className="nav-container">
        <h2 className="nav-title">Form Management System</h2>
        <div className="nav-buttons">
          {pages.map((page) => (
            <button
              key={page.id}
              className={`nav-button ${
                currentPage === page.id ? "active" : ""
              }`}
              onClick={() => onPageChange(page.id)}
            >
              {page.label}
            </button>
          ))}
        </div>
      </div>
    </nav>
  );
};

export default Navigation;
