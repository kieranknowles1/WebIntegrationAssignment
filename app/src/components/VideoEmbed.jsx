import PropTypes from 'prop-types'
import React from 'react'

/**
 * VideoEmbed component
 *
 * Component to embed a YouTube video
 *
 * @param {object} props
 * @param {string} props.link Embed link for the video. Use `getEmbedLink` to convert a full YouTube link to an embed link
 *
 * @author Kieran Knowles
 * @generated GitHub Copilot was used to assist in writing this code
 */
function VideoEmbed (props) {
  return (
    <iframe
        width="560"
        height="315"
        src={props.link}
        title="YouTube video player"
        allow="fullscreen" />
  )
}
VideoEmbed.propTypes = {
  link: PropTypes.string.isRequired
}

export default VideoEmbed
