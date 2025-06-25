import { useState, useEffect } from "react";
import { FormRepositoryImpl } from "../../infrastructure/repositories/FormRepositoryImpl";

export const useForm = (formType = "kejadian") => {
  const [formData, setFormData] = useState(null);
  const [formValues, setFormValues] = useState({});
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError] = useState(null);
  const [submissionData, setSubmissionData] = useState(null);

  const repository = new FormRepositoryImpl();

  useEffect(() => {
    loadFormData();
    loadSubmissionData();
  }, [formType]);

  const loadFormData = async () => {
    try {
      setLoading(true);
      const data = await repository.getFormData(formType);
      setFormData(data);

      const initialValues = {};
      data.fields.forEach((field) => {
        if (field.type === "radio_button") {
          initialValues[field.id] = [];
        } else {
          initialValues[field.id] = "";
        }
      });
      setFormValues(initialValues);
    } catch (err) {
      setError(err.message);
    } finally {
      setLoading(false);
    }
  };

  const updateField = (fieldId, value) => {
    setFormValues((prev) => ({
      ...prev,
      [fieldId]: value,
    }));
  };

  const submitForm = async () => {
    try {
      setSubmitting(true);
      const result = await repository.saveFormData({
        formId: formData.id,
        formType: formType,
        values: formValues,
      });

      alert(result.data.message);
      await loadSubmissionData();
      return result;
    } catch (err) {
      setError(err.message);
      alert("Error: " + err.message);
    } finally {
      setSubmitting(false);
    }
  };

  const loadSubmissionData = async () => {
    try {
      const data = await repository.getSubmissionData(formType);
      setSubmissionData(data);
    } catch (err) {
      setError(err.message);
    }
  };

  return {
    formData,
    formValues,
    loading,
    submitting,
    error,
    submissionData,
    updateField,
    submitForm,
    loadSubmissionData,
  };
};
