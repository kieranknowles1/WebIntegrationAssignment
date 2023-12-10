import PropTypes from 'prop-types'
import React from 'react'

/** @typedef {'loading'|'error'|'done'} LoadingStatus */

/**
 * Get the highest status in the order error > loading > done
 * I.e., any error is an error, any loading and no error is loading, and all done is done.
 * @param {LoadingStatus[]} statuses
 */
export function getHighestStatus (statuses) {
  if (statuses.includes('error')) return 'error'
  if (statuses.includes('loading')) return 'loading'
  return 'done'
}

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
