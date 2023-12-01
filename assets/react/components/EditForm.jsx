import React, { useState, useEffect } from 'react';

const EditForm = ({ entity, onSave, onCancel, title }) => {
  const [editedEntity, setEditedEntity] = useState({ ...entity });

  useEffect(() => {
    setEditedEntity({
      languageCode: 'en',
      destLanguageCode: 'fr',
      ...entity
    });
  }, [entity]);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setEditedEntity(prev => ({ ...prev, [name]: value }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    onSave(editedEntity);
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>{title}</h2>

      <div>
        <label htmlFor="text">Text:</label>
        <textarea
          name="text"
          id="text"
          value={editedEntity.text}
          onChange={handleChange}></textarea>
      </div>

      <div>
        <label htmlFor={"languageCode"}>Language:</label>
        <select
          name="languageCode"
          id="languageCode"
          value={editedEntity.languageCode}
          onChange={handleChange}>
          <option value="en">English</option>
          <option value="fr">French</option>
          <option value="de">German</option>
          <option value="es">Spanish</option>
          <option value="ua">Ukrainian</option>
        </select>
      </div>

      <div>
        <label htmlFor={"destLanguageCode"}>Target language:</label>
        <select
          name="destLanguageCode"
          id="destLanguageCode"
          value={editedEntity.destLanguageCode}
          onChange={handleChange}>
          <option value="en">English</option>
          <option value="fr">French</option>
          <option value="de">German</option>
          <option value="es">Spanish</option>
          <option value="ua">Ukrainian</option>
        </select>
      </div>

      <div>
        <label htmlFor="translatedText">Translation:</label>
        <textarea
          name="translatedText"
          id="translatedText"
          value={editedEntity.translatedText}
          onChange={handleChange}></textarea>
      </div>

      <button type="submit">Save Changes</button>
      <button type="button" onClick={() => onCancel()}>Cancel</button>
    </form>
  );
};

export default EditForm;
