import PropTypes from 'prop-types'
import React from 'react'
import deleteNote from '../api/deleteNote'
import UserContext from '../contexts/UserContext'
import useNotNullContext from '../utils/useNotNullContext'
import InvalidTokenError from '../errors/InvalidTokenError'

/**
 * Note component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Note (props) {
  // Shouldn't be possible to get here without being logged in
  const context = useNotNullContext(UserContext)

  const newLinesText = props.text
    .split('\n')
    .map((line, i) => <React.Fragment key={i}>{line}<br /></React.Fragment>)

  function handleEdit () {
    // TODO: textarea to edit
    // TODO: Make PUT request to edit note
    alert(`Edit note ${props.id}`)
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
      <button className='float-right' onClick={handleDelete}>Delete</button>
      <button className='float-right' onClick={handleEdit}>Edit</button>
      <p>{newLinesText}</p>
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
