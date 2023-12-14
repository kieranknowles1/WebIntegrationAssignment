import PropTypes from 'prop-types'
import React from 'react'

/**
 * Note component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Note (props) {
  const newLinesText = props.text
    .split('\n')
    .map((line, i) => <React.Fragment key={i}>{line}<br /></React.Fragment>)

  function handleEdit () {
    // TODO: textarea to edit
    // TODO: Make PUT request to edit note
    alert(`Edit note ${props.id}`)
  }

  function handleDelete () {
    // TODO: Confirm delete
    // TODO: Make DELETE request to delete note
    // TODO: Remove self from notes
    alert(`Delete note ${props.id}`)
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
  id: PropTypes.number.isRequired
}

export default Note
