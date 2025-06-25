import React, { useState, useEffect } from "react";
import { useForm } from "../hooks/useForm";
import "./styles/list_data_page.css";

const ListDataPage = () => {
  const [allSubmissions, setAllSubmissions] = useState([]);

  const { loading, error, submissionData } = useForm("kerugian"); 

  useEffect(() => {
    if (submissionData) {
      if (submissionData.data && Array.isArray(submissionData.data)) {
        setAllSubmissions(submissionData.data);
      } else if (Array.isArray(submissionData)) {
        setAllSubmissions(submissionData);
      }
    }
  }, [submissionData]);

  const getFormTypeIcon = (type) => {
    switch (type) {
      case "kerugian":
        return (
          <svg
            className="icon icon-red"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
          >
            <line x1="12" y1="1" x2="12" y2="23"></line>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
          </svg>
        );
      case "kejadian":
        return (
          <svg
            className="icon icon-blue"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
          >
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14,2 14,8 20,8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10,9 9,9 8,9"></polyline>
          </svg>
        );
      default:
        return (
          <svg
            className="icon icon-gray"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
          >
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14,2 14,8 20,8"></polyline>
          </svg>
        );
    }
  };

  const getFormTypeLabel = (type) => {
    switch (type) {
      case "kerugian":
        return "Detail Kerugian";
      case "kejadian":
        return "Detail Kejadian";
      default:
        return type;
    }
  };

  const getBadgeClass = (type) => {
    switch (type) {
      case "kerugian":
        return "badge badge-red";
      case "kejadian":
        return "badge badge-blue";
      default:
        return "badge badge-gray";
    }
  };

  const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString("id-ID", {
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    });
  };

  const getKeyValues = (values) => {
    if (!values || typeof values !== "object") return [];

    const keyValues = [];
    Object.entries(values).forEach(([key, value]) => {
      if (Array.isArray(value)) {
        keyValues.push(
          ...value.map((v) => {
            if (typeof v === "object" && v.label) {
              return v.label;
            }
            return v;
          })
        );
      } else {
        keyValues.push(value);
      }
    });
    return keyValues.slice(0, 3);
  };

  // Loading state
  if (loading) {
    return (
      <div className="page-container">
        <div className="page-header">
          <h1 className="page-title">Data Submissions</h1>
          <p className="page-subtitle">Daftar semua form submissions</p>
        </div>
        <div className="loading-container">
          <div className="loading">Loading...</div>
        </div>
      </div>
    );
  }

  // Error state
  if (error) {
    return (
      <div className="page-container">
        <div className="page-header">
          <h1 className="page-title">Data Submissions</h1>
          <p className="page-subtitle">Daftar semua form submissions</p>
        </div>
        <div className="error-container">
          <div className="error">Error: {error}</div>
        </div>
      </div>
    );
  }

  return (
    <div className="page-container">
      <div className="page-header">
        <h1 className="page-title">Data Submissions</h1>
        <p className="page-subtitle">Daftar semua form submissions</p>
        {/* Debug info - bisa dihapus nanti */}
        <div style={{ fontSize: "12px", color: "#666", marginTop: "8px" }}>
          Total submissions: {allSubmissions.length}
        </div>
      </div>

      {/* Submissions List */}
      <div className="submissions-list">
        {allSubmissions.length === 0 ? (
          <div className="empty-state">
            <div className="empty-icon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14,2 14,8 20,8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10,9 9,9 8,9"></polyline>
              </svg>
            </div>
            <h3 className="empty-title">Tidak ada data submissions</h3>
            <p className="empty-description">
              Belum ada form yang telah disubmit.
            </p>
          </div>
        ) : (
          allSubmissions.map((submission) => (
            <div key={submission.id} className="submission-card">
              <div className="card-content">
                <div className="card-header">
                  <div className="card-title-section">
                    {getFormTypeIcon(submission.form_type)}
                    <div className="title-info">
                      <h3 className="card-title">
                        {getFormTypeLabel(submission.form_type)}
                      </h3>
                      <p className="card-subtitle">ID: {submission.id}</p>
                    </div>
                  </div>

                  <div className="badge-section">
                    <span className={getBadgeClass(submission.form_type)}>
                      {getFormTypeLabel(submission.form_type)}
                    </span>
                  </div>
                </div>

                <div className="date-info">
                  <div className="date-item">
                    <svg
                      className="date-icon"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                    >
                      <rect
                        x="3"
                        y="4"
                        width="18"
                        height="18"
                        rx="2"
                        ry="2"
                      ></rect>
                      <line x1="16" y1="2" x2="16" y2="6"></line>
                      <line x1="8" y1="2" x2="8" y2="6"></line>
                      <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span>Created: {formatDate(submission.created_at)}</span>
                  </div>

                  <div className="date-item">
                    <svg
                      className="date-icon"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                    >
                      <circle cx="12" cy="12" r="10"></circle>
                      <polyline points="12,6 12,12 16,14"></polyline>
                    </svg>
                    <span>Updated: {formatDate(submission.updated_at)}</span>
                  </div>
                </div>

                <div className="key-values">
                  <h4 className="values-title">Key Values:</h4>
                  <div className="values-list">
                    {getKeyValues(submission.values).map((value, index) => (
                      <span key={index} className="value-tag">
                        {String(value).substring(0, 50)}
                        {String(value).length > 50 ? "..." : ""}
                      </span>
                    ))}
                    {submission.values &&
                      Object.keys(submission.values).length > 3 && (
                        <span className="value-tag value-tag-more">
                          +{Object.keys(submission.values).length - 3} more
                        </span>
                      )}
                  </div>
                </div>
              </div>
            </div>
          ))
        )}
      </div>
    </div>
  );
};

export default ListDataPage;
