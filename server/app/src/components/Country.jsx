import PropTypes from 'prop-types'
import React from 'react'

/**
 * Country component
 * For use in a `<ul>` element
 *
 * @param {object} params
 * @param {string} params.name Name of the country
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Country (params) {
  return (
    <li>{params.name}</li>
  )
}
Country.propTypes = {
  name: PropTypes.string.isRequired
}

export default Country
