import PropTypes from 'prop-types'
import React from 'react'

import UserContext from '../contexts/UserContext'
/** @typedef {import('../api/getAuthorAffiliations').AuthorAffiliation} AuthorAffiliation */
import { getContentAuthorAffiliations } from '../api/getAuthorAffiliations'
/** @typedef {import('../api/getNotes').Note} Note */
import getNotes from '../api/getNotes'

import AuthorItem from './AuthorItem'
/** @typedef {import('./LoadingDisplay').LoadingStatus} LoadingStatus */
import LoadingDisplay from './LoadingDisplay'
import Note from './Note'

/**
 * ContentAuthorList component
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function ContentDetails (props) {
  const context = React.useContext(UserContext)

  const [status, setStatus] = React.useState(/** @type {LoadingStatus} */ ('loading'))
  const [authors, setAuthors] = React.useState(/** @type {AuthorAffiliation[]} */ ([]))

  const [notes, setNotes] = React.useState(/** @type {Note[]} */ ([]))

  React.useEffect(() => {
    getContentAuthorAffiliations(props.contentId)
      .then(authors => {
        setAuthors(authors)
        setStatus('done')
      })
      .catch(() => setStatus('error'))
  }, [props.contentId])

  React.useEffect(() => {
    if (context === null) return
    getNotes(context.token, props.contentId)
      .then(notes => {
        setNotes(notes)
      })
      // TODO: Log out user if token is invalid
      .catch(() => setStatus('error'))
  }, [context && context.token, props.contentId])

  return (
    <div>
      <h3>Authors:</h3>
      <ul>
        <LoadingDisplay status={status} />
        {authors.map(author => <AuthorItem key={author.author_id} {...author} />)}
      </ul>

      {/* TODO: Implement */}
      {context !== null
        ? (
          <>
            <h3>Notes:</h3>
            <LoadingDisplay status={status} />
            {status === 'done' && notes.length === 0 && <p>No notes found</p>}
            <ul>
              {notes.map(note => <Note key={note.id} text={note.text} />)}
            </ul>
          </>
          )
        : (
          <p>Please log in to view or create notes</p>
          )}
    </div>
  )
}
ContentDetails.propTypes = {
  contentId: PropTypes.number.isRequired
}

export default ContentDetails
