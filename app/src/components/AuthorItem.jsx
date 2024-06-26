import PropTypes from 'prop-types'
import React from 'react'

/**
 * AuthorItem component
 * Displays an author and their affiliation
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function AuthorItem (props) {
  return (
    <li>
      <p>{props.author_name} - {props.institution}, {props.city}, {props.country}</p>
    </li>
  )
}
AuthorItem.propTypes = {
  author_name: PropTypes.string.isRequired,
  country: PropTypes.string.isRequired,
  city: PropTypes.string.isRequired,
  institution: PropTypes.string.isRequired
}

export default AuthorItem
