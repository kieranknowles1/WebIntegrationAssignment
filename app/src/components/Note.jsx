import PropTypes from 'prop-types'
import React from 'react'

import InvalidTokenError from '../errors/InvalidTokenError'
import UserContext from '../contexts/UserContext'
import deleteNote from '../api/deleteNote'
import useNotNullContext from '../utils/useNotNullContext'
import putNote from '../api/putNote'

/**
 * Note component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Note (props) {
  // Shouldn't be possible to get here without being logged in
  const context = useNotNullContext(UserContext)

  const [editing, setEditing] = React.useState(false)
  const [editText, setEditText] = React.useState(props.text)

  const newLinesText = props.text
    .split('\n')
    .map((line, i) => <React.Fragment key={i}>{line}<br /></React.Fragment>)

  function handleEditStart () {
    setEditing(true)
    setEditText(props.text)
  }

  function handleEditSubmit (e) {
    e.preventDefault()

    // TODO: PUT new note text
    putNote(context.token, props.id, editText)
      .then(() => {
        setEditing(false)
        props.setAllNotes(props.allNotes.map(note => {
          if (note.id === props.id) {
            return { ...note, text: editText }
          } else {
            return note
          }
        }))
      })
      .catch(err => {
        if (err instanceof InvalidTokenError) {
          props.handleTokenRejected()
        } else {
          console.error(err)
          alert('Failed to edit note')
        }
      })
  }

  function handleDelete () {
    if (!window.confirm('Are you sure you want to delete this note?')) {
      return
    }

    deleteNote(context.token, props.id)
      .then(() => {
        // Remove note from list without having to make another request
        props.setAllNotes(props.allNotes.filter(note => note.id !== props.id))
      })
      .catch(err => {
        if (err instanceof InvalidTokenError) {
          props.handleTokenRejected()
        } else {
          console.error(err)
          alert('Failed to delete note')
        }
      })
  }

  return (
    <li className='border border-gray-950'>
      {editing
        ? (
          <>
            <form onSubmit={handleEditSubmit}>
              <label>New text:
                <textarea
                  value={editText}
                  onChange={e => setEditText(e.target.value)}
                  required
                  className='w-full h-32'
                />
              </label>
              <input type='submit' value='Save' />
              <button onClick={() => setEditing(false)}>Cancel</button>
            </form>
          </>
          )
        : (
          <>
            <button className='float-right' onClick={handleDelete}>Delete</button>
            <button className='float-right' onClick={handleEditStart}>Edit</button>
            <p>{newLinesText}</p>
          </>
          )}
    </li>
  )
}
Note.propTypes = {
  text: PropTypes.string.isRequired,
  id: PropTypes.number.isRequired,
  allNotes: PropTypes.array.isRequired,
  setAllNotes: PropTypes.func.isRequired,
  handleTokenRejected: PropTypes.func.isRequired
}

export default Note
