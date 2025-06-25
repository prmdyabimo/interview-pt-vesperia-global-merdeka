import React from "react";
import FormInput from "../components/FormInput";
import { useForm } from "../hooks/useForm";
import "./styles/index.css";

const DetailKejadianResikoPage = () => {
  const {
    formData,
    formValues,
    loading,
    submitting,
    error,
    updateField,
    submitForm,
  } = useForm("kejadian");

  const handleSubmit = (e) => {
    e.preventDefault();
    submitForm();
  };

  if (loading) {
    return (
      <div className="loading-container">
        <div className="loading">Loading...</div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="error-container">
        <div className="error">Error: {error}</div>
      </div>
    );
  }

  return (
    <div className="form-container">
      <div className="form-header">
        <h1>{formData?.name}</h1>
      </div>

      <form onSubmit={handleSubmit} className="form">
        {formData?.fields.map((field) => (
          <FormInput
            key={field.id}
            field={field}
            value={formValues[field.id]}
            onChange={updateField}
          />
        ))}

        <div className="form-actions">
          <button type="submit" className="submit-btn" disabled={submitting}>
            {submitting ? "Menyimpan..." : "Simpan"}
          </button>
        </div>
      </form>
    </div>
  );
};

export default DetailKejadianResikoPage;
