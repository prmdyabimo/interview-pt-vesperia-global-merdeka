export class FormApi {
  constructor(baseURL = import.meta.env.VITE_API_BASE_URL) {
    this.baseURL = baseURL;
    this.headers = {
      "Content-Type": "application/json",
      Accept: "application/json",
      "x-api-key": import.meta.env.VITE_API_KEY,
    };
  }

  async fetchFormData(formType = "kejadian") {
    try {
      // Validasi formType
      if (!["kejadian", "kerugian"].includes(formType)) {
        throw new Error("Invalid form type. Must be kejadian or kerugian");
      }

      const response = await fetch(`${this.baseURL}/forms/${formType}`, {
        method: "GET",
        headers: this.headers,
      });

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(
          errorData.message ||
            `HTTP Error: ${response.status} ${response.statusText}`
        );
      }

      const data = await response.json();
      return data;
    } catch (error) {
      console.error(`Error fetching form data for ${formType}:`, error);
      throw error;
    }
  }

  async submitFormData(formData) {
    try {
      // Validasi formData
      if (
        !formData.formType ||
        !["kejadian", "kerugian"].includes(formData.formType)
      ) {
        throw new Error("Invalid or missing formType in form data");
      }

      const response = await fetch(
        `${this.baseURL}/forms/${formData.formType}/submit`,
        {
          method: "POST",
          headers: this.headers,
          body: JSON.stringify(formData),
        }
      );

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error("Gagal menyimpan data form");
      }

      return await response.json();
    } catch (error) {
      console.error("Error submitting form data:", error);
      throw error;
    }
  }

  async fetchSubmissionData() {
    try {
      const response = await fetch(`${this.baseURL}/submissions`, {
        method: "GET",
        headers: this.headers,
      });

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        throw new Error(
          errorData.message ||
            `HTTP Error: ${response.status} ${response.statusText}`
        );
      }

      return await response.json();
    } catch (error) {
      console.error(`Error fetching ${formType} submissions:`, error);
      throw error;
    }
  }
}
