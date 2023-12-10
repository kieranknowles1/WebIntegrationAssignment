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
      <li className='bg-background-listitem text-foreground-listitem rounded-md p-3'>
        {/** // TODO: Emphasise this and type */}
        <h2>{params.title}</h2>
        <p>{params.abstract}</p>
        <p>{params.type}</p>
        {params.award && <p>⭐ {params.award}</p>}
      </li>
  )
}
ContentItem.propTypes = {
  title: PropTypes.string.isRequired,
  abstract: PropTypes.string,
  type: PropTypes.string.isRequired,
  award: PropTypes.string,
}

export default ContentItem
