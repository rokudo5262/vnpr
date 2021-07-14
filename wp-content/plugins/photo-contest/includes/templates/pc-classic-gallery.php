<?php

		//Mobile two columns
		$html .= '<div class="one-half classic zip pcmobile">';
		$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" alt="" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . $title . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . $author . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';
		//Mobile one column
		$html .= '<div class="one-full classic zip pcmobile">';
		$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . $title . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . $author . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';


        //Desktop
		if ($columns_number == 1) {

		$html .= '<div class="one-full classic zip pcdesktop">';
		$html .= '<div class="imagebox"><a data-test="full" href="' . $blogurl . '"><img src="' . $large_image[0] . '" alt="" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . $title . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . $author . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';

		} elseif ($columns_number == 2) {

		$html .= '<div class="one-half classic pop pcdesktop">';
		$html .= '<div class="imagebox"><a data-test="big" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" alt="" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . $title . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . $author . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category1 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';

		} elseif ($columns_number == 3) {

		$html .= '<div class="one-third classic pop pcdesktop">';
		$html .= '<div class="imagebox"><a data-test="middle" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" alt="" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . contest_shorter($title, 30) . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . contest_shorter($author, 30) . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category2 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';

		} elseif ($columns_number == 4) {

		$html .= '<div class="one-fourth classic pop pcdesktop">';
		$html .= '<div class="imagebox"><a data-test="small" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" alt="" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . contest_shorter($title, 30) . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . contest_shorter($author, 30) . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category3 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';

		} elseif ($columns_number == 5) {

		$html .= '<div class="one-fifth classic  pop pcdesktop">';
		$html .= '<div class="imagebox"><a data-test="small" href="' . $blogurl . '"><img src="' . $image_attributes[0] . '" alt="" /></a><div class="clear"></div></div>';
		$html .= '<div class="clear"></div><div class="gallery-title-autor"><div class="author" title="' . $title . '">' . contest_shorter($title, 20) . '</div><div class="pc-title' . $hide_author . '"><a href="' . $author_url . '">' . contest_shorter($author, 20) . '</a></div><div class="clear"></div></div>';
		$html .= '<div class="clear"></div>';
		$html .= '<div class="gallery-votes">' . $category3 . '<span class="' . $hide_views . '"><i class="fa fa-eye  fa-fw"></i>&nbsp;<span>' . $views . '</span></span><span class="' . $hide_votes . '">' .$vote_rate_symbol. '&nbsp;<span>' . $votes . '</span></span><div class="clear"></div></div>';
		$html .= '</div>';

		}
