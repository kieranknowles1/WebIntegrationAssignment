import PropTypes from 'prop-types'
import React from 'react'

/**
 * LoadingDisplay component
 * Display a loading message while the page is loading that disappears when the page is loaded, or changes to an error message if there was an error.
 *
 * @param {object} params
 * @param {'loading'|'error'|'done'} params.status The status of the page.
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function LoadingDisplay (params) {
  switch (params.status) {
    case 'loading':
      return <p>Loading...</p>
    case 'error':
      return <p>There was an error loading data. See the console for details.</p>
    case 'done':
      return null
    default:
      throw new Error('Invalid status')
  }
}
LoadingDisplay.propTypes = {
  status: PropTypes.oneOf(['loading', 'error', 'done']).isRequired
}

export default LoadingDisplay
