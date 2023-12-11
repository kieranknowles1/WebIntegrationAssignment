import PropTypes from 'prop-types'
import React from 'react'

import UserContext from '../contexts/UserContext'
import { getContentAuthorAffiliations } from '../api/getAuthorAffiliations'

import AuthorItem from './AuthorItem'
import LoadingDisplay from './LoadingDisplay'

/**
 * ContentAuthorList component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function ContentAuthorList (props) {
  const context = React.useContext(UserContext)

  const [status, setStatus] = React.useState('loading')
  const [authors, setAuthors] = React.useState([])

  React.useEffect(() => {
    getContentAuthorAffiliations(props.contentId)
      .then(authors => {
        setAuthors(authors)
        setStatus('done')
      })
      .catch(() => setStatus('error'))
  }, [props.contentId])

  return (
    <div>
      <h3>Authors:</h3>
      <ul>
        <LoadingDisplay status={status} />
        {authors.map(author => <AuthorItem key={author.id} {...author} />)}
      </ul>

      {/* TODO: Implement */}
      {context !== null
        ? (
          <button>My Notes</button>
          )
        : (
          <p>Please log in to view or create notes</p>
          )}
    </div>
  )
}
ContentAuthorList.propTypes = {
  contentId: PropTypes.number.isRequired
}

export default ContentAuthorList
