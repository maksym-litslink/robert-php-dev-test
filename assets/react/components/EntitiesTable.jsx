import React, {useState, useEffect} from 'react';
import axios from 'axios';
import EditForm from "./EditForm";

const EntitiesTable = () => {
  const [entities, setEntities] = useState([]);
  const [isEditing, setIsEditing] = useState(false);
  const [editingEntity, setEditingEntity] = useState(null);
  const [isCreating, setIsCreating] = useState(false);

  useEffect(() => {
    axios.get('/api/translation_units', {
      'headers': {'Accept': 'application/ld+json'}
    })
      .then(response => {
        setEntities(response.data['hydra:member']);
      })
      .catch(error => {
        console.error('There was an error fetching the entities', error);
      });
  }, []);

  const createEntity = (newEntity) => {
    const jsonLdEntity = {
      '@context': '/api/contexts/TranslationUnit',
      '@type': 'TranslationUnit',
      ...newEntity
    };
    axios.post('/api/translation_units', jsonLdEntity, {
      'headers': {'Content-Type': 'application/ld+json'}
    })
      .then(response => {
        setIsCreating(false);
        setEntities([...entities, response.data]);
      })
      .catch(error => {
        console.error('There was an error creating the entity', error);
      });
  };


  const startEditing = (entity) => {
    setIsEditing(true);
    setIsCreating(false);
    setEditingEntity(entity);
  };

  const saveEdit = (editedEntity) => {
    const jsonLdEntity = {
      '@context': '/api/contexts/TranslationUnit',
      '@type': 'TranslationUnit',
      ...editedEntity
    };
    axios.put(`/api/translation_units/${editedEntity.id}`, jsonLdEntity, {
      'headers': {'Content-Type': 'application/ld+json'}
    })
      .then(response => {
        setEntities(entities.map(entity => entity.id === editedEntity.id ? response.data : entity));
        setIsEditing(false);
        setEditingEntity(null);
      })
      .catch(error => {
        console.error('There was an error updating the entity', error);
      });
  };

  const deleteEntity = (entity) => {
    axios.delete(`/api/translation_units/${entity.id}`, {
      'headers': {'Content-Type': 'application/ld+json'}
    })
      .then(response => {
        setEntities(entities.filter(e => e.id !== entity.id));
      })
      .catch(error => {
        console.error('There was an error deleting the entity', error);
      });
  }

  return (
    <div>
      <h1>Entities</h1>
      <table>
        <thead>
        <tr>
          <th>ID</th>
          <th>Text</th>
          <th>Language</th>
          <th>Target Language</th>
          <th>Translated Text</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {entities.map(entity => (
          <tr key={entity.id}>
            <td>{entity.id}</td>
            <td>{entity.text}</td>
            <td>{entity.languageCode}</td>
            <td>{entity.destLanguageCode}</td>
            <td>{entity.translatedText}</td>
            <td>
              <button onClick={() => startEditing(entity)}>Edit</button>
              <button onClick={() => deleteEntity(entity)}>Delete</button>
            </td>
          </tr>
        ))}
        </tbody>
      </table>

      {!isCreating && !isEditing && (
        <button onClick={() => setIsCreating(true)}>Create new entity</button>
      )}

      {isCreating && (
        <EditForm entity={{}} onSave={createEntity} onCancel={() => setIsCreating(false)} title="Create new entity" />
      )}

      {isEditing && (
        <EditForm entity={editingEntity} onSave={saveEdit} onCancel={() => setIsEditing(false)} title={`Edit ${editingEntity.id}`} />
      )}
    </div>
  );
};

export default EntitiesTable;




