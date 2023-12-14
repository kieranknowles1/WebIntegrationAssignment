import PropTypes from 'prop-types'
import React from 'react'

/**
 * Note component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Note (props) {
  return (
    <li className='border-solid border-2 border-gray-400'>
      {props.text}
    </li>
  )
}
Note.propTypes = {
  text: PropTypes.string.isRequired
}

export default Note
