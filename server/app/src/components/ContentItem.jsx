import PropTypes from 'prop-types'
import React from 'react'

/** @typedef {import('../api/getContent').Content} Content */

/**
 * ContentItem component
 *
 * @param {Content} params
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function ContentItem (params) {
  return (
      <li>
        {/** // TODO: Am I misusing H2? */}
        <h2>{params.title}</h2>
        <p>{params.abstract}</p>
        <p>{params.type}</p>
      </li>
  )
}
ContentItem.propTypes = {
  title: PropTypes.string.isRequired,
  abstract: PropTypes.string.isRequired,
  type: PropTypes.string.isRequired
}

export default ContentItem
