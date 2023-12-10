import PropTypes from 'prop-types'
import React from 'react'

import AuthorItem from './AuthorItem'
import LoadingDisplay from './LoadingDisplay'

/**
 * ContentAuthorList component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function ContentAuthorList (props) {
  const [status, setStatus] = React.useState('loading')
  const [authors, setAuthors] = React.useState([])

  return (
    <ul>
      <LoadingDisplay status={status} />
      {authors.map(author => <AuthorItem key={author.id} {...author} />)}
    </ul>
  )
}
ContentAuthorList.propTypes = {
  contentId: PropTypes.number.isRequired
}

export default ContentAuthorList
