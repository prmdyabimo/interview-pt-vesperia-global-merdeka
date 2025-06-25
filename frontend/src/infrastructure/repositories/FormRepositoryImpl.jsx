import { FormRepository } from "../../domain/repositories/FormRepository";
import { FormData } from "../../domain/entities/FormField";
import { FormApi } from "../api/FormApi";

export class FormRepositoryImpl extends FormRepository {
  constructor() {
    super();
    this.api = new FormApi();
  }

  async getFormData(formType = "kejadian") {
    try {
      const rawData = await this.api.fetchFormData(formType);
      return rawData.data;
    } catch (error) {
      throw new Error("Failed to fetch form data: " + error.message);
    }
  }

  async saveFormData(formData) {
    try {
      const result = await this.api.submitFormData(formData);
      return result;
    } catch (error) {
      throw new Error("Failed to save form data: " + error.message);
    }
  }

  async getSubmissionData() {
    try {
      const rawData = await this.api.fetchSubmissionData();
      return rawData.data;
    } catch (error) {
      throw new Error("Failed to fetch submission data: " + error.message);
    }
  }
}
