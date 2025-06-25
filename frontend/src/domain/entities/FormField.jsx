export class FormField {
  constructor(
    id,
    label,
    type,
    subType,
    description,
    options = [],
    answer = null
  ) {
    this.id = id;
    this.label = label;
    this.type = type;
    this.subType = subType;
    this.description = description;
    this.options = options;
    this.answer = answer;
  }

  static fromJson(json) {
    return new FormField(
      json.id,
      json.label,
      json.type,
      json.sub_type || null,
      json.description,
      json.options || [],
      json.answer
    );
  }
}

export class FormData {
  constructor(id, name, fields = []) {
    this.id = id;
    this.name = name;
    this.fields = fields;
  }

  static fromJson(json) {
    const fields = json.payloads.map((payload) => FormField.fromJson(payload));
    return new FormData(json.id, json.name, fields);
  }
}
