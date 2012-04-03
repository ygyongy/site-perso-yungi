<?xml version="1.0" encoding="utf-8"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"/> 

<xsl:template match="/">  

	<html>
		<head>
			<title><xsl:value-of select="resume/title"/></title>
			<link rel="stylesheet" href="style.css" type="text/css" media="screen"/>
		</head>
		<body>
		
			<div class="resume">
		
				<h1><xsl:value-of select="resume/title" /></h1>
				<h2><xsl:value-of select="resume/identity/firstname" /> <xsl:value-of select="resume/identity/lastname" /></h2>
				
				<p><xsl:value-of select="resume/identity/address/street" />, <xsl:value-of select="resume/identity/address/zip" />, <xsl:value-of select="resume/identity/address/city" /></p>
				
				<h3>Education</h3>
				
				<ul>
					<xsl:for-each select="resume/educations/education">  
						<xsl:sort select="@from" data-type="number" order="descending"/>
						
							<xsl:choose>
							
								<xsl:when test="position() mod 2 = 0">
									<li class="even">From <xsl:value-of select="@from"/> to <xsl:value-of select="@to"/>, <xsl:value-of select="school"/>, <xsl:value-of select="degree"/></li>  
								</xsl:when>
								
								<xsl:otherwise>
									<li class="odd">From <xsl:value-of select="@from"/> to <xsl:value-of select="@to"/>, <xsl:value-of select="school"/>, <xsl:value-of select="degree"/></li>  
								</xsl:otherwise>
								
							</xsl:choose>
							
					</xsl:for-each>
				</ul>
			
			</div>
			
		</body>
	</html>
 
</xsl:template>  

</xsl:stylesheet>