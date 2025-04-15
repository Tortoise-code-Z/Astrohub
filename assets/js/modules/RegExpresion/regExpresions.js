export const USERNAME_EXPR_REG = /^[a-zA-Z0-9._]{3,20}$/;
export const PASSWORD_EXPR_REG = /^.{6,}$/;
export const NAME_EXPR_REG = /^[a-zA-Záéíóú  ]{2,50}$/;
export const SURNAME_EXPR_REG = /^[a-zA-Záéíóú  ]{2,50}$/;
export const EMAIL_EXPR_REG = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
export const TEL_EXPR_REG = /^\d{7,15}$/;
export const DATEBIRTH_EXPR_REG = /^\d{4}-\d{2}-\d{2}$/;
export const DIR_EXPR_REG = /^[a-zA-Z.,_\/0-9 \-]{0,100}$/;

export const REASON_EXPR_REG = /^[a-zA-Z0-9.,-_áéíóú ]{3,100}$/;

export const TITLE_NEW_EXPR_REG = /^[a-zA-Z0-9.,-_áéíóúñÑ ]{3,70}$/;
export const DESC_NEW_EXPR_REG = /^[a-zA-Z0-9.,-_áéíóúñÑ ]{3,170}$/;
export const IMAGE_NEW_URL_EXPR_REG = /^[\w,\s-]+\.(jpg|jpeg|png)$/;
