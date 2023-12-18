import PropTypes from 'prop-types'
import React from 'react'

import UserContext from '../contexts/UserContext'
/** @typedef {import('../api/getAuthorAffiliations').AuthorAffiliation} AuthorAffiliation */
import { getContentAuthorAffiliations } from '../api/getAuthorAffiliations'
/** @typedef {import('../api/getNotes').Note} Note */
import getNotes from '../api/getNotes'

import InvalidTokenError from '../errors/InvalidTokenError'
import postNote from '../api/postNote'
/** @typedef {import('./LoadingDisplay').LoadingStatus} LoadingStatus */
import LoadingDisplay from './LoadingDisplay'
import Note from './Note'

import AuthorItem from './AuthorItem'

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
      .catch(() => {
        props.handleTokenRejected()
        setStatus('error')
      })
  }, [context && context.token, props.contentId])

  const [noteText, setNoteText] = React.useState('')
  /** @param {React.FormEvent} e */
  function handleCreateNote (e) {
    e.preventDefault()

    if (context === null) {
      alert('Please log in to create notes')
      return
    }

    postNote(context.token, props.contentId, noteText)
      .then(id => {
        setNotes([...notes, { id, content_id: props.contentId, text: noteText }])
        setNoteText('')
      })
      .catch(err => {
        if (err instanceof InvalidTokenError) {
          props.handleTokenRejected()
        } else {
          console.error(err)
          alert('Failed to create note')
        }
      })
  }

  return (
    <div>
      <h3>Authors:</h3>
      <ul>
        <LoadingDisplay status={status} />
        {authors.map(author => <AuthorItem key={author.author_id} {...author} />)}
      </ul>
      {context !== null
        ? (
          <div className='border border-black'>
            <h3>Notes:</h3>
            <LoadingDisplay status={status} />
            {status === 'done' && notes.length === 0 && <p>No notes found</p>}
            <ul>
              {notes.map(note => <Note key={note.id} id={note.id} text={note.text} />)}
            </ul>
            <form onSubmit={handleCreateNote}>
              <label>Make a note:
                <textarea
                  value={noteText}
                  onChange={e => setNoteText(e.target.value)}
                  required
                  className='w-full h-32'
              /></label>
              <input type='submit' value='Save Note' />
            </form>
          </div>
          )
        : (
          <p>Please log in to view or create notes</p>
          )}
    </div>
  )
}
ContentDetails.propTypes = {
  contentId: PropTypes.number.isRequired,
  handleTokenRejected: PropTypes.func.isRequired
}

export default ContentDetails
