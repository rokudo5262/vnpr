<?php

        //Mobile two columns
		$html .= '<div class="one-half classic zip pcmobile">';
		$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" alt="" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . $title . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . $author . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';
		//Mobile one column
		$html .= '<div class="one-full classic zip pcmobile">';
		$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . $title . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . $author . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';

		//Desktop
		if ($columns_number == 1) {

		$html .= '<div class="modern-full pcmodern pcdesktop">';
		$html .= '<div class="modern-image-box"><a href="' . $full_image[0] . '" data-lightbox="image-1"><img src="' . $large_image[0] . '" alt="' . $title . '" /></a></div>';
		$html .= '<div class="modern-top-box"><a href="' . $full_image[0] . '" data-lightbox="image-2">';
		$html .= '<div class="modern-top-box-title font20">' . $title . '</div>';
		$html .= '<div class="modern-top-box-author ' . $hide_author . ' font14">' . __('Author:', 'photo-contest') . ' ' . $author . '</div>';
		$html .= '<div class="modern-top-box-votes ' . $hide_votes . ' font14">' . $vote_rate_text . ' ' . $votes . '</div>';
		$html .= '</a></div>';
		$html .= '<div class="modern-bottom-box">';
		$html .= '<span class="' . $loveicon . '2" onclick="javascript:location.href=\'' . $blogurl . '\'"></span>';
		$html .= '</div>';
		$html .= '<div class="modern-lightbox-box pc-fa1"><a href="' . $full_image[0] . '" data-lightbox="image-3">';
		$html .= '<span class="pc-searchicon2"></span>';
		$html .= '</a></div>';
		$html .= '<div class="clear"></div>';
		$html .= '</div>';

		} elseif ($columns_number == 2) {

		$html .= '<div class="modern-half pcmodern pcdesktop">';
		$html .= '<div class="modern-image-box"><a href="' . $full_image[0] . '" data-lightbox="image-1"><img src="' . $image_attributes[0] . '" alt="' . $title . '"/></a></div>';
		$html .= '<div class="modern-top-box"><a href="' . $full_image[0] . '" data-lightbox="image-2">';
		$html .= '<div class="modern-top-box-title font20">' . $title . '</div>';
		$html .= '<div class="modern-top-box-author ' . $hide_author . ' font14">' . __('Author:', 'photo-contest') . ' ' . $author . '</div>';
		$html .= '<div class="modern-top-box-votes ' . $hide_votes . ' font14">' . $vote_rate_text . ' ' . $votes . '</div>';
		$html .= '</a></div>';
		$html .= '<div class="modern-bottom-box">';
		$html .= '<span class="' . $loveicon . '2" onclick="javascript:location.href=\'' . $blogurl . '\'"></span>';
		$html .= '</div>';
		$html .= '<div class="modern-lightbox-box pc-fa2"><a href="' . $full_image[0] . '" data-lightbox="image-3">';
		$html .= '<span class="pc-searchicon2"></span>';
		$html .= '</a></div>';
		$html .= '<div class="clear"></div>';
		$html .= '</div>';

		} elseif ($columns_number == 3) {

		$html .= '<div class="modern-third pcmodern pcdesktop">';
		$html .= '<div class="modern-image-box"><a href="' . $full_image[0] . '" data-lightbox="image-1"><img src="' . $image_attributes[0] . '" alt="' . $title . '"/></a></div>';
		$html .= '<div class="modern-top-box"><a href="' . $full_image[0] . '" data-lightbox="image-2">';
		$html .= '<div class="modern-top-box-title font16">' . $title . '</div>';
		$html .= '<div class="modern-top-box-author ' . $hide_author . ' font12">' . __('Author:', 'photo-contest') . ' ' . $author . '</div>';
		$html .= '<div class="modern-top-box-votes ' . $hide_votes . ' font12">' . $vote_rate_text . ' ' . $votes . '</div>';
		$html .= '</a></div>';
		$html .= '<div class="modern-bottom-box">';
		$html .= '<span class="' . $loveicon . '" onclick="javascript:location.href=\'' . $blogurl . '\'"></span>';
		$html .= '</div>';
		$html .= '<div class="modern-lightbox-box pc-fa3"><a href="' . $full_image[0] . '" data-lightbox="image-3">';
		$html .= '<span class="pc-searchicon"></span>';
		$html .= '</a></div>';
		$html .= '<div class="clear"></div>';
		$html .= '</div>';

		} elseif ($columns_number == 4) {

		$html .= '<div class="modern-fourth pcmodern pcdesktop">';
		$html .= '<div class="modern-image-box"><a href="' . $full_image[0] . '" data-lightbox="image-1"><img src="' . $image_attributes[0] . '" alt="' . $title . '"/></a></div>';
		$html .= '<div class="modern-top-box"><a href="' . $full_image[0] . '" data-lightbox="image-2">';
		$html .= '<div class="modern-top-box-title font14">' . $title . '</div>';
		$html .= '<div class="modern-top-box-author ' . $hide_author . ' font11">' . __('Author:', 'photo-contest') . ' ' . $author . '</div>';
		$html .= '<div class="modern-top-box-votes ' . $hide_votes . ' font11">' . $vote_rate_text . ' ' . $votes . '</div>';
		$html .= '</a></div>';
		$html .= '<div class="modern-bottom-box">';
		$html .= '<span class="' . $loveicon . '3" onclick="javascript:location.href=\'' . $blogurl . '\'"></span>';
		$html .= '</div>';
		$html .= '<div class="modern-lightbox-box pc-fa4"><a href="' . $full_image[0] . '" data-lightbox="image-3">';
		$html .= '<span class="pc-searchicon3"></span>';
		$html .= '</a></div>';
		$html .= '<div class="clear"></div>';
		$html .= '</div>';

		} elseif ($columns_number == 5) {

		$html .= '<div class="modern-fifth pcmodern pcdesktop">';
		$html .= '<div class="modern-image-box"><a href="' . $full_image[0] . '" data-lightbox="image-1"><img src="' . $image_attributes[0] . '" alt="' . $title . '"/></a></div>';
		$html .= '<div class="modern-top-box"><a href="' . $full_image[0] . '" data-lightbox="image-2">';
		$html .= '<div class="modern-top-box-title font14">' . $title . '</div>';
		$html .= '<div class="modern-top-box-author ' . $hide_author . ' font11">' . __('Author:', 'photo-contest') . ' ' . $author . '</div>';
		$html .= '<div class="modern-top-box-votes ' . $hide_votes . ' font11">' . $vote_rate_text . ' ' . $votes . '</div>';
		$html .= '</a></div>';
		$html .= '<div class="modern-bottom-box">';
		$html .= '<span class="' . $loveicon . '3" onclick="javascript:location.href=\'' . $blogurl . '\'"></span>';
		$html .= '</div>';
		$html .= '<div class="modern-lightbox-box pc-fa5"><a href="' . $full_image[0] . '" data-lightbox="image-3">';
		$html .= '<span class="pc-searchicon3"></span>';
		$html .= '</a></div>';
		$html .= '<div class="clear"></div>';
		$html .= '</div>';

		}
