import React from 'react'

import ContentItem from '../components/ContentItem'
import LoadingDisplay from '../components/LoadingDisplay'

/** @typedef {import('../api/getContent').Content} Content */
import getContent from '../api/getContent'

/**
 * Content page
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function Content () {
  const [status, setStatus] = React.useState('loading')
  /** @type {[Content, function (Content): void]} */
  const [content, setContent] = React.useState(null)

  // TODO: Keep previous pages in memory
  const [page, setPage] = React.useState(1)

  React.useEffect(() => {
    setStatus('loading')
    getContent(page)
      .then(content => {
        setContent(content.map((item, index) => <ContentItem key={index} {...item} />))
        setStatus('done')
      })
      .catch(err => {
        console.error(err)
        setStatus('error')
      })
  }, [page])

  return (
    <main>
      <h1>Content</h1>
      <button onClick={() => setPage(page - 1)} disabled={page <= 1}>Previous</button>
      <button onClick={() => setPage(page + 1)}>Next</button>
      <LoadingDisplay status={status} />
      <ul>
        {content}
      </ul>
    </main>
  )
}

export default Content
